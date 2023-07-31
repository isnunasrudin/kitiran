<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Mail\RespondMail;
use App\Models\Message;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Mail;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Informasi')->schema([
                    Tab::make('Responden')->schema([
                        Grid::make(3)->schema([
                            TextInput::make('name'),
                            TextInput::make('email'),
                            DatePicker::make('created_at')->format('H')->label('Dikirim Pada')
                        ]),
                        Textarea::make('message')->label('Pesan'),
                        FileUpload::make('attachments')->multiple()->enableDownload()->label('Lampiran')->hidden(fn(Message $record) => !count($record->attachments ?? []))->label('Lampiran')
                    ]),
                    Tab::make('Balasan')->schema([
                        Grid::make()->schema([
                            Group::make([
                                TextInput::make('name'),
                            ])->relationship('user'),
                            DatePicker::make('answered_at'),
                        ]),
                        Textarea::make('answer')->label('Balasan'),
                        FileUpload::make('answer_attachments')->enableDownload()->label('Lampiran')->hidden(fn(Message $record) => !count($record->answer_attachments ?? []))->label('Lampiran')
                    ])->hidden(fn(Message $record) => !$record->answered())
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('#'),
                Tables\Columns\TextColumn::make('name')->label('Nama'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('message')->limit(10)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Jawab')->action(function(Message $record, array $data) : void{
                    $record->update([
                        'answer' => $data['answer'],
                        'user_id' => auth()->user()->id,
                        'answer_attachments' => $data['answer_attachments'],
                        'answered_at' => now()
                    ]);


                    Mail::to($record->email, $record->name)->send(new RespondMail($record));
                    
                })
                ->form([
                    Textarea::make('answer')->label('Balasan')->required(),
                    FileUpload::make('answer_attachments')->multiple()->label('Lampiran Balasan')
                ])
                ->hidden(fn(Message $record) => $record->answered())
                ,
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMessages::route('/'),
            'view' => Pages\ViewMessage::route('/{record}/view')
            // 'create' => Pages\CreateMessage::route('/create'),
            // 'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
