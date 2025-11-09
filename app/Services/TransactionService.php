<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    public function calculerFrais(Transaction $transaction): float
    {
        $fraisConfig = $transaction->typeOperation->frais()->first();
        if (!$fraisConfig) return 0;

        return $fraisConfig->frais_fixe + ($transaction->montant * $fraisConfig->pourcentage_frais);
    }

    public function calculerMontantTotal(Transaction $transaction): float
    {
        return $transaction->montant + $this->calculerFrais($transaction);
    }

    public function verifierSoldeDisponible(Transaction $transaction): bool
    {
        $soldeDisponible = $transaction->compteSource->getSoldeVirtualAttribute();
        return $soldeDisponible >= $this->calculerMontantTotal($transaction);
    }
}
