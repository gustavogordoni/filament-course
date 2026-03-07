<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make("name")
                ->label("Nome")
                ->placeholder("Nome completo do usuário")
                ->required()
                ->rules(["required", "min:10"])
                ->validationMessages([
                    "required" => "O campo nome é obrigatório.",
                    "min" => "O nome deve conter pelo menos 10 caracteres.",
                ]),

            TextInput::make("email")
                ->label("Email")
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
                ->placeholder("Senha do usuário")
                ->required()
                ->password()
                ->revealable()
                ->rules(["required", "min:8"])
                ->validationMessages([
                    "required" => "O campo senha é obrigatório.",
                    "min" => "A senha deve conter pelo menos 8 caracteres.",
                ])
                ->visibleOn('create'),

            TextInput::make("phone")
                ->label("Telefone")
                ->placeholder("(__) _____-____")
                ->required()
                ->tel()
                ->mask("(99) 9999-9999")
                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                ->rules(["required", "min:14"])
                ->validationMessages([
                    "required" => "O campo telefone é obrigatório.",
                    "min" => "O telefone deve conter pelo menos 14 caracteres.",
                ]),

            FileUpload::make("avatar")
                ->label("Imagem de avatar")
                ->directory("avatars")
                ->imageEditor()
                ->avatar()
                ->circleCropper()
                ->automaticallyOpenImageEditorForAspectRatio(),

            Toggle::make("is_admin")
                ->label("Administrador")
                ->onIcon(Heroicon::Check)
                ->offIcon(Heroicon::XMark)
                ->onColor("success")
                ->offColor("danger"),
        ]);
    }
}
