<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class DecretScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // dd(Auth::user()->departement->inbox->id);
        // if (Auth::user()->departement) {
        //     # code...
        //     $builder->where('inbox_id', Auth::user()->departement->inbox->id)->orWhere('init', Auth::user()->departement->name)
        //         ->orWhere('status', 'Signé');
        // }
        if (Auth::user()->worker) {
            if (Auth::user()->worker->name == 'DEPARTEMENT') {
                $builder->where('init', Auth::user()->departement->name)->orderBy('updated_at', 'DESC');
            } else {
                $builder->whereNotNull('submit_at')->orderBy('updated_at', 'DESC');
            }
            # code...
        }
    }
}
