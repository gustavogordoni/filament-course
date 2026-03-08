<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Informações")
                ->columnSpanFull()
                ->icon(Heroicon::InformationCircle)
                ->description("Informação de título e slugs")
                ->schema([
                    TextInput::make("title")
                        ->helperText("Título da postagem")
                        ->label("Título")
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, $set) {
                            $set("slug", Str::slug($state));
                        })
                        ->placeholder("Título da postagem"),

                    TextInput::make("slug")
                        ->helperText("Slug da postagem")
                        ->label("Slug")
                        ->required()
                        ->placeholder("Slug da postagem"),
                ])
                ->columns(2),

            Section::make("Conteúdo")
                ->description("Conteúdo da postagem")
                ->icon(Heroicon::Document)
                ->schema([
                    RichEditor::make("content")
                        ->helperText("Conteúdo da postagem")
                        ->label("Conteúdo")
                        ->required(),
                ])
                ->columnSpanFull(),

            Section::make("Miniatura")
                ->description("Miniatura da postagem (thumbnail)")
                ->icon(Heroicon::Photo)
                ->schema([
                    FileUpload::make("thumbnail")
                        ->label("Miniatura")
                        ->image()
                        ->helperText("Miniatura da postagem (thumbnail)")
                        ->directory("thumbs")
                        ->label("Thumb")
                        ->required(),
                ])
                ->columnSpanFull(),

            Section::make("Categorias e Tags")
                ->description("Selecione Categorias e Tags")
                ->icon(Heroicon::Tag)
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    Select::make("category_id")
                        ->label("Categoria")
                        ->searchable()
                        ->preload()
                        ->relationship("category", "name"),

                    Select::make("tags")
                        ->label("Tags")
                        ->searchable()
                        ->multiple()
                        ->preload()
                        ->relationship("tags", "tag_name"),
                ]),


            Section::make("Publicação")
                ->description("Seleção para postagem ser, ou não, publicada")
                ->icon(Heroicon::Check)
                ->columnSpanFull()
                ->schema([
                    Select::make("is_published")
                        ->label("Publicar")
                        ->options([
                            0 => "Não",
                            1 => "Sim",
                        ])
                        ->required(),
                ]),
        ]);
    }
}
