<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Services\TransactionService;

class TransactionObserver
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function creating(Transaction $transaction)
    {
        if (app()->environment('production') &&
            !$this->transactionService->verifierSoldeDisponible($transaction)) {
            throw new \Exception('Solde insuffisant');
        }
    }

    public function created(Transaction $transaction)
    {
        // Cache les calculs dans meta_donnees
        $transaction->meta_donnees = array_merge($transaction->meta_donnees ?? [], [
            'frais_calcules' => $this->transactionService->calculerFrais($transaction),
            'montant_total' => $this->transactionService->calculerMontantTotal($transaction)
        ]);
        $transaction->saveQuietly();
    }

    public function updated(Transaction $transaction)
    {
        if ($transaction->wasChanged('statut')) {
            $compteService = new CompteOmPayService();
            $transaction->compteSource->solde_cache = $compteService->calculerSoldeVirtuel($transaction->compteSource);
            $transaction->compteSource->save();
        }
    }
}
