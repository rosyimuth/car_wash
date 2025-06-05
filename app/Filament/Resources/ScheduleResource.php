<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),
                Forms\Components\TimePicker::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->required(),
                Forms\Components\TimePicker::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->required()
                    ->after('jam_mulai'),
                Forms\Components\TextInput::make('kuota')
                    ->label('Kuota')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jam_mulai')
                    ->label('Jam Mulai'),
                Tables\Columns\TextColumn::make('jam_selesai')
                    ->label('Jam Selesai'),
                Tables\Columns\TextColumn::make('kuota')
                    ->label('Kuota')
                    ->numeric()
                    ->sortable()
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
                Tables\Filters\SelectFilter::make('kuota')
                ->label('Kuota')
                ->options(fn () => Schedule::query()
                    ->select('kuota')
                    ->distinct()
                    ->orderBy('kuota')
                    ->pluck('kuota', 'kuota')
                    ->toArray()
                ),
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
            ->emptyStateHeading('Belum Ada Jadwal')
            ->emptyStateDescription('Silakan tambahkan jadwal baru terlebih dahulu.')
            ->emptyStateActions([
            Tables\Actions\CreateAction::make()->label('Tambah Jadwal'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSchedules::route('/'),
        ];
    }
}
