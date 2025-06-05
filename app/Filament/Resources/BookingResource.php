<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Nama Customer')
                    ->required(),
                Forms\Components\Select::make('schedule_id')
                    ->relationship('schedule', 'tanggal')
                    ->label('Tanggal')
                    ->required(),
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'nama')
                    ->label('Layanan')
                    ->required(),
                Forms\Components\TextInput::make('plat_nomor')
                    ->label('Plat Nomor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('merk')
                    ->label('Merk')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('users.name')
                    ->label('Nama Customer')
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedules.tanggal')
                    ->label('Jadwal')
                    ->sortable(),
                Tables\Columns\TextColumn::make('services.nama')
                    ->label('Layanan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('plat_nomor')
                    ->label('Plat Nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('merk')
                    ->label('Merk')
                    ->searchable(),
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
                Tables\Filters\SelectFilter::make('schedule_id')
                    ->label('Tanggal')
                    ->relationship('schedule', 'tanggal'),
                Tables\Filters\SelectFilter::make('merk')
                    ->label('Merk'),
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
            ->emptyStateHeading('Belum Ada Booking')
            ->emptyStateDescription('Silakan tambahkan booking baru terlebih dahulu.')
            ->emptyStateActions([
            Tables\Actions\CreateAction::make()->label('Tambah Booking'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBookings::route('/'),
        ];
    }
}
