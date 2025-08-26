<?php

namespace App\Filament\Resources\Attendances\Schemas;

use App\Models\Student;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->label('Siswa')
                    ->options(Student::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->placeholder('Pilih siswa'),

                DatePicker::make('date')
                    ->label('Tanggal')
                    ->required()
                    ->default(now())
                    ->maxDate(now())
                    ->placeholder('Pilih tanggal'),

                DateTimePicker::make('time_in')
                    ->label('Waktu Masuk')
                    ->required()
                    ->default(now())
                    ->seconds(false)
                    ->placeholder('Pilih waktu masuk'),
            ]);
    }
}
