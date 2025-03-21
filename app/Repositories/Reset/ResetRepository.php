<?php

namespace App\Repositories\Reset;

use Illuminate\Support\Facades\DB;

class ResetRepository
{
    
    private function disableForeignKeyChecks()
    {
        DB::statement('SET foreign_key_checks = 0;');
    }

    
    private function enableForeignKeyChecks()
    {
        DB::statement('SET foreign_key_checks = 1;');
    }

    
    public function resetDatabase()
    {
        $this->disableForeignKeyChecks();

        
        DB::table('crm2.leads')->truncate();
        DB::table('crm2.comments')->truncate();
        DB::table('crm2.mails')->truncate();
        DB::table('crm2.tasks')->truncate();
        DB::table('crm2.projects')->truncate();
        DB::table('crm2.absences')->truncate();
        DB::table('crm2.contacts')->truncate();
        DB::table('crm2.invoice_lines')->truncate();
        DB::table('crm2.appointments')->truncate();
        DB::table('crm2.payments')->truncate();
        DB::table('crm2.invoices')->truncate();
        DB::table('crm2.offers')->truncate();
        DB::table('crm2.clients')->truncate();

        $adminUserIds = DB::table('crm2.role_user')
            ->join('crm2.roles', 'crm2.role_user.role_id', '=', 'crm2.roles.id')
            ->where('crm2.roles.external_id', '=', '9db1a62b-944c-4cb2-9632-150bf7425734')
            ->pluck('user_id')
            ->toArray();

        // Supprimer les utilisateurs non administrateurs
        DB::table('crm2.users')
            ->whereNotIn('id', $adminUserIds)
            ->delete();

        // Supprimer les rôles des utilisateurs non administrateurs
        DB::table('crm2.role_user')
            ->whereNotIn('user_id', $adminUserIds)
            ->delete();

        // Supprimer les associations dans department_user
        DB::table('crm2.department_user')
            ->whereNotIn('user_id', $adminUserIds)
            ->delete();

        // Suppression optionnelle de certaines tables
        // DB::table('crm2.products')->truncate();
        // DB::table('crm2.subscriptions')->truncate();
        // DB::table('crm2.activities')->truncate();

        $this->enableForeignKeyChecks();
    }
}
