<?php

namespace App\Http\Controllers;

use App\Repositories\Reset\ResetRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ResetController extends Controller
{
    protected $resetRepository;

    public function __construct(ResetRepository $resetRepository)
    {
        $this->resetRepository = $resetRepository;
    }

    
    public function index(): View
    {
        return view('reset');
    }

    
    public function resetDatabase(): RedirectResponse
    {
        $this->resetRepository->resetDatabase();
        return redirect()->route('reset.index')->with('success', 'Base de données réinitialisée avec succès.');
    }
}
