<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Standard;
use App\Models\Student;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Notifications\Notification;
use function Laravel\Prompts\select;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

   //protected static bool $shouldRegisterNavigation = false;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\TextInput::make('name')
                     ->required(),
                 Forms\Components\TextInput::make('student_id')
                     ->required()
                     ->minLength('3'),
                 Forms\Components\TextInput::make('address_1'),
                 Forms\Components\TextInput::make('address_2'),
//                  Forms\Components\Select::make('name')
//                      ->relationship( 'standard','name'),
                Forms\Components\Select::make('standard_id')
                    ->label('Standard')
                    ->options(Standard::all()->pluck('name', 'id'))
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('id')->sortable(),
                 Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                  Tables\Columns\TextColumn::make('standard.name')->searchable()
            ])
           // ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions(actions: [
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])

            ;
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
            'index' => Pages\ListStudents::route('/'),
//            'create' => Pages\CreateStudent::route('/create'),
//            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
