<?php

namespace App\Filament\Resources\Replies;

use App\Filament\Resources\Replies\Pages\CreateReply;
use App\Filament\Resources\Replies\Pages\EditReply;
use App\Filament\Resources\Replies\Pages\ListReplies;
use App\Filament\Resources\Replies\Schemas\ReplyForm;
use App\Filament\Resources\Replies\Tables\RepliesTable;
use App\Models\Reply;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ReplyResource extends Resource
{
    protected static ?string $model = Reply::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;

    protected static string | UnitEnum | null $navigationGroup = 'Postagens';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Resposta';
    protected static ?string $pluralModelLabel = 'Respostas';
    protected static ?string $navigationLabel = 'Respostas';

    public static function form(Schema $schema): Schema
    {
        return ReplyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RepliesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReplies::route('/'),
            'create' => CreateReply::route('/create'),
            'edit' => EditReply::route('/{record}/edit'),
        ];
    }
}
