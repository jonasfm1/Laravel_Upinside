<?php
if (!empty($filters['transaction_status'])) {
    $filterTransaction = explode(',', $filters['transaction_status']);

    $query->whereHas('transactions', function ($queryTransaction) use ($filterTransaction) {

        if (!in_array('blocked', $filterTransaction)) {
            $statusEnum = collect($filterTransaction)->map(function ($transaction){
                return (new Transaction())->present()->getStatusEnum($transaction);
            })->toArray();
            $queryTransaction->whereIn('status_enum', $statusEnum);

        } else {
            $queryTransaction->where(function ($query) {
                $query->where('transactions.release_date', '>', '2020-05-25') //data que começou a bloquear
                ->orWhereHas('sale', function ($query) {
                    $query->where('is_chargeback_recovered', true);
                });
            })->where('transactions.release_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('tracking_required', true);
        }

        $queryTransaction->where('type', Transaction::TYPE_PRODUCER)
            ->whereNull('invitation_id')
            ->where('is_waiting_withdrawal', 0)
            ->whereNull('withdrawal_id');
    });
}

TRANSFERIDO = 2673
PENENTE = 1
BLOQUEADO = 17

MEDINA

$query->whereHas('transactions', function ($qrTransaction) use ($filterTransaction) {
        $transactionPresenter = (new Transaction())->present();
        $statusEnum = [];
        foreach($filterTransaction as $item){
            if($item <> 'blocked'){
                $statusEnum[] = $transactionPresenter->getStatusEnum($item);
            }
        }

        if(in_array('blocked',$filterTransaction))
        {
            $qrTransaction->where(function ($qr) use ($statusEnum) {
                $qr->where(function ($query) {
                    $query->where('transactions.release_date', '>', '2020-05-25') //data que começou a bloquear
                    ->orWhereHas('sale', function ($query) {
                        $query->where('is_chargeback_recovered', true);
                    });
                })->where('transactions.release_date', '<=', Carbon::now()->format('Y-m-d'))
                ->where('tracking_required', true);

                if(count($statusEnum)>0){
                    $qr->orWhereIn('status_enum', $statusEnum);
                }
            });

        }else{
            $qrTransaction->whereIn('status_enum', $statusEnum);
        }

        $qrTransaction->where('type', Transaction::TYPE_PRODUCER)
        ->whereNull('invitation_id')
        ->where('is_waiting_withdrawal', 0)
        ->whereNull('withdrawal_id');

    });
