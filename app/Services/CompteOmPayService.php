<?php

namespace App\Services;

use App\Models\CompteOmPay;

class CompteOmPayService
{
    public function calculerSoldeVirtuel(CompteOmPay $compte): float
    {
        $entrees = $compte->transactionsRecues()
            ->where('statut', 'validee')
            ->sum('montant');

        $sorties = $compte->transactions()
            ->where('statut', 'validee')
            ->get()
            ->sum(function ($transaction) {
                return app(TransactionService::class)->calculerMontantTotal($transaction);
            });

        return $entrees - $sorties;
    }
}
