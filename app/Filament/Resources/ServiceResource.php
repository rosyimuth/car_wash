<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    // protected static ?string $navigationLabel = 'Data User';
    // protected static ?string $pluralLabel = 'Daftar Data User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->disk('public')
                    ->directory('foto') 
                    ->imagePreviewHeight('100')
                    ->loadingIndicatorPosition('left')
                    ->uploadProgressIndicatorPosition('left')
                    ->removeUploadedFileButtonPosition('right')
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Layanan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis')
                    ->label('Jenis Layanan')
                    ->options([
                        'R' => 'Regular',
                        'M' => 'Medium',
                        'C' => 'Complete',
                        'D' => 'Drywash',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('harga')
                    ->label('Harga')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->height(40)
                    ->square(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(20),
                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis')
                    ->label('Jenis Layanan')
                    ->options([
                        'R' => 'Regular',
                        'M' => 'Medium',
                        'C' => 'Complete',
                        'D' => 'Drywash',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Layanan')
            ->emptyStateDescription('Silakan tambahkan layanan baru terlebih dahulu.')
            ->emptyStateActions([
            Tables\Actions\CreateAction::make()->label('Tambah Layanan'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageServices::route('/'),
        ];
    }
}
