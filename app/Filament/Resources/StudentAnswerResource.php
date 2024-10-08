<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\StudentAnswer;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentAnswerResource\Pages;
use App\Filament\Resources\StudentAnswerResource\RelationManagers;

class StudentAnswerResource extends Resource
{
    protected static ?string $model = StudentAnswer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Result Management';

    public function __construct()
    {
        // Menambahkan middleware pada resource ini
        $this->middleware('role:teacher|admin|operator');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('exam_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('exam_question_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('answer')
                    ->required(),
                Forms\Components\Toggle::make('is_correct')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exam.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_question.question')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_correct')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false; // Menghilangkan tombol "Add"
    }

    public static function canEdit($record): bool
    {
        return false; // Menghilangkan tombol "Add"
    }
    public static function canDeleteAny(): bool
    {
        return false; // Menghilangkan tombol "Add"
    }


    public static function canViewAny(): bool
    {
        // Menggunakan Spatie untuk memastikan hanya role "operator" yang bisa melihat resource
        return Auth::user()->hasAnyRole(['operator', 'admin']);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudentAnswers::route('/'),
            // 'create' => Pages\CreateStudentAnswer::route('/create'),
            // 'edit' => Pages\EditStudentAnswer::route('/{record}/edit'),
        ];
    }
}
