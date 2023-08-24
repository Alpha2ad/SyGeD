<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    // public function getTitle(): string
    // {
    //     return trans('filament-user::user.resource.title.list');
    // }

    protected static ?string $title = 'LISTE DES UTILISATEURS';

    protected function getActions(): array
    {
        return [
            CreateAction::make()
                ->label('AJOUTER UN UTILISATEURS')
        ];
    }
}