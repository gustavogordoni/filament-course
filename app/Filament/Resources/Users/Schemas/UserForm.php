<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Support\Icons\Heroicon;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(
                fn($operation) => match ($operation) {
                    "edit" => "Edição de usuário",
                    default => "Cadastro de usuário",
                },
            )
                ->description(
                    fn($operation) => match ($operation) {
                        "edit"
                            => "Formulário para edição de informações do usuário",
                        default
                            => "Formulário para realização de cadastro de usuários no sistema",
                    },
                )
                ->icon(Heroicon::UserPlus)
                ->columns(2)
                ->collapsible()
                ->columnSpanFull()
                ->schema([
                    TextInput::make("name")
                        ->label("Nome")
                        ->helperText("Nome completo do usuário")
                        // ->hint("Nome do usuário")
                        ->placeholder("Nome completo do usuário")
                        ->required()
                        ->rules(["required", "min:10"])
                        ->validationMessages([
                            "required" => "O campo nome é obrigatório.",
                            "min" =>
                                "O nome deve conter pelo menos 10 caracteres.",
                        ]),

                    TextInput::make("phone")
                        ->label("Telefone")
                        ->helperText("Telefone do usuário para contato")
                        ->placeholder("(__) _____-____")
                        ->required()
                        ->tel()
                        ->mask("(99) 9999-9999")
                        ->telRegex(
                            '/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/',
                        )
                        ->rules(["required", "min:14"])
                        ->validationMessages([
                            "required" => "O campo telefone é obrigatório.",
                            "min" =>
                                "O telefone deve conter pelo menos 14 caracteres.",
                        ]),

                    TextInput::make("email")
                        ->label("Email")
                        ->helperText(
                            "Endereço de e-mail do usuário para autenticação",
                        )
                        ->placeholder("Endereço de e-mail")
                        ->required()
                        ->unique()
                        ->email()
                        ->rules(["required", "email"])
                        ->validationMessages([
                            "required" => "O campo email é obrigatório.",
                            "email" => "O email deve ser válido.",
                        ]),
                    TextInput::make("password")
                        ->label("Senha")
                        ->helperText("Senha do usuário para autenticação")
                        ->placeholder("Senha do usuário")
                        ->required()
                        ->password()
                        ->revealable()
                        ->rules(["required", "min:8"])
                        ->validationMessages([
                            "required" => "O campo senha é obrigatório.",
                            "min" =>
                                "A senha deve conter pelo menos 8 caracteres.",
                        ])
                        ->visibleOn("create"),
                ]),

            Section::make("Avatar")
                ->description(
                    "Imagem para utilização como foto de perfil do usuário",
                )
                ->columnSpanFull()
                ->icon(Heroicon::Photo)
                ->schema([
                    FileUpload::make("avatar")
                        ->label("Avatar")
                        ->directory("avatars")
                        ->imageEditor()
                        // ->avatar
                        ->image()
                        ->circleCropper(),
                    // ->automaticallyOpenImageEditorForAspectRatio()
                ]),

            Section::make("Tipo de Usuário")
                ->columnSpanFull()
                ->description("Definição do tipo de usuário")
                ->icon(Heroicon::LockClosed)
                ->schema([
                    Toggle::make("is_admin")
                        ->label("Administrador")
                        ->onIcon(Heroicon::Check)
                        ->offIcon(Heroicon::XMark)
                        ->onColor("success")
                        ->offColor("danger"),
                ]),
        ]);
    }
}
