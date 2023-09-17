<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Decret;
use Illuminate\Auth\Access\HandlesAuthorization;

class DecretPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_decret');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Decret  $decret
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Decret $decret): bool
    {
        return $user->can('view_decret');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_decret');
    }

    /**
     * Determine whether the user can soumettre models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function soumettre(User $user, Decret $decret)
    {
        if (auth()->user()->departement) {
            if (auth()->user()->departement->name === $decret->init && auth()->user()->departement->inbox->id === $decret->inbox->id && $decret->okPRIMATURE == false && $decret->okPRG == false && $decret->Signé == false && $decret->Submit == false) {
                return $user->can('soumettre_decret');
            }
        } else {
            return $user->can('soumettre_decret');
        }
    }
    /**
     * Determine whether the user can valide models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function valide(User $user, Decret $decret)
    {
        if (auth()->user()->departement && auth()->user()->worker) {
            if ((auth()->user()->worker->name === 'SGG' || auth()->user()->worker->name === 'PRIMATURE') && auth()->user()->departement->inbox->id === $decret->inbox->id && $decret->Signé == false && $decret->Submit == true) {
                return $user->can('valide_decret');
            }
        } else {
            return $user->can('valide_decret');
        }
    }
    /**
     * Determine whether the user can publish models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function pulbish(User $user, Decret $decret)
    {
        if (auth()->user()->departement && auth()->user()->worker) {
            if (auth()->user()->worker->name === 'SGG' && auth()->user()->departement->inbox->id === $decret->inbox->id && $decret->Signé == true && $decret->Publié == false && $decret->Submit == true) {
                return $user->can('pulbish_decret');
            }
        } else {
            return $user->can('pulbish_decret');
        }
    }
    /**
     * Determine whether the user can retourne models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function retourne(User $user, Decret $decret)
    {
        if (auth()->user()->departement && auth()->user()->worker) {
            if ((auth()->user()->worker->name === 'SGG' || auth()->user()->worker->name === 'PRIMATURE' || auth()->user()->worker->name === 'PRG') && auth()->user()->departement->inbox->id === $decret->inbox->id && $decret->Signé == false && $decret->Submit == true) {
                return $user->can('retourne_decret');
            }
        } else {
            return $user->can('retourne_decret');
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Decret  $decret
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Decret $decret)
    {
        if (auth()->user()->departement) {
            if (auth()->user()->departement->name === $decret->init && auth()->user()->departement->inbox->id === $decret->inbox->id && $decret->okPRIMATURE == false && $decret->okSGG == false && $decret->Submit == false) {
                return $user->can('update_decret');
            }
        } else {
            return $user->can('update_decret');
        }
    }
    /**
     * Determine whether the user can signe the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Decret  $decret
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function signe(User $user, Decret $decret)
    {


        if (auth()->user()->departement && auth()->user()->worker) {
            if (auth()->user()->worker->name === 'PRG' && auth()->user()->departement->inbox->id === $decret->inbox->id && $decret->Signé == false && $decret->Publié == false && $decret->okPRIMATURE == true && $decret->okSGG == true && $decret->Submit == true) {
                return $user->can('signe_decret');
            }
        } else {
            return $user->can('signe_decret');
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Decret  $decret
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Decret $decret): bool
    {
        return $user->can('delete_decret');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_decret');
    }
    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Decret  $decret
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Decret $decret): bool
    {
        return $user->can('force_delete_decret');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_decret');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Decret  $decret
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Decret $decret): bool
    {
        return $user->can('restore_decret');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_decret');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Decret  $decret
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, Decret $decret): bool
    {
        return $user->can('replicate_decret');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_decret');
    }
}