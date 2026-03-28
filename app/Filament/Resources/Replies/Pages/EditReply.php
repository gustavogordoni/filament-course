<?php

namespace App\Filament\Resources\Replies\Pages;

use App\Filament\Resources\Replies\ReplyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReply extends EditRecord
{
    protected static string $resource = ReplyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
