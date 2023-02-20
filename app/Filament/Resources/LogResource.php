<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogResource\Pages;
use App\Filament\Resources\LogResource\RelationManagers;
use App\Models\Log;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LogResource extends Resource
{
    protected static ?string $model = Log::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    TextColumn::make('id')->sortable()->grow(false)->label('#'),
                    TextColumn::make('text.update_id')->sortable()->grow(false)->label('text.update_id'),
                    TextColumn::make('text.message.from.username')->sortable()->grow(false)->label('text.message.from.username'),
                    TextColumn::make('text.message.message_id')->sortable()->grow(false)->label('text.message.message_id'),
                ]),
                Panel::make([
                    Stack::make([
                        TextColumn::make('text')->grow(false)->label('text.message.from')->getStateUsing(fn ($record) => "text->message->from" .  json_encode(json_decode(json_encode($record))->text->message->from)),
                        // TextColumn::make('text.message.from.is_bot'),
                        // TextColumn::make('text.message.from.first_name'),
                        // TextColumn::make('text.message.from.language_code'),
                        TextColumn::make('text.message.chat')->grow(false)->label('text.message.chat')->getStateUsing(fn ($record) =>  "text->message->chat" . json_encode(json_decode(json_encode($record))->text->message->chat)),
                        // TextColumn::make('text.message.chat.first_name'),
                        // TextColumn::make('text.message.chat.username'),
                        // TextColumn::make('text.message.chat.type'),
                        TextColumn::make('text.message.date')->grow(false)->label('text.message.date'),
                        TextColumn::make('text.message.text')->grow(false)->label('text.message.text'),
                        TextColumn::make('text.message.entities')->grow(false)->label('text.message.entities')->getStateUsing(fn ($record) =>  "text->message->entities" . json_encode(json_decode(json_encode($record))->text->message->entities)),
                    ]),
                ])->collapsible(),
            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])->defaultSort('id', 'desc')
            ->contentGrid([
                'md' => 2,
            ]);
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
            'index' => Pages\ListLogs::route('/'),
            'create' => Pages\CreateLog::route('/create'),
            'edit' => Pages\EditLog::route('/{record}/edit'),
        ];
    }
}
