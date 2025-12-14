<?php

namespace App\Exports;

use App\Models\Peminjam;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PeminjamExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithEvents,
    ShouldAutoSize
{
    protected $totalPeminjaman = 0;

    /**
     * Ambil data & hitung total
     */
    public function collection()
    {
        $data = Peminjam::withCount('peminjamans')->get();

        // Total seluruh peminjaman
        $this->totalPeminjaman = $data->sum('peminjamans_count');

        return $data;
    }

    /**
     * Mapping data ke kolom
     */
    public function map($p): array
    {
        return [
            $p->nik,
            $p->nama_peminjam,
            $p->peminjamans_count,
        ];
    }

    /**
     * Heading tabel
     */
    public function headings(): array
    {
        return [
            'NIK',
            'Nama Peminjam',
            'Jumlah Peminjaman',
        ];
    }

    /**
     * Event Excel
     */
    public function registerEvents(): array
    {
        return [

            // =============================
            // JUDUL & SUBJUDUL
            // =============================
            BeforeSheet::class => function (BeforeSheet $event) {

                $event->sheet->setCellValue('A1', 'DATA PEMINJAM ASET');
                $event->sheet->mergeCells('A1:C1');

                $event->sheet->setCellValue(
                    'A2',
                    'Diekspor pada: ' . now()->translatedFormat('d F Y')
                );
                $event->sheet->mergeCells('A2:C2');

                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                $event->sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 10,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                // Geser tabel ke baris 3
                $event->sheet->insertNewRowBefore(3, 2);
            },

            // =============================
            // BORDER, TOTAL & FOOTER
            // =============================
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                // Border tabel
                $sheet->getStyle("A3:C{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Heading bold
                $sheet->getStyle('A3:C3')->applyFromArray([
                    'font' => ['bold' => true],
                ]);

                // =============================
                // TOTAL PEMINJAMAN
                // =============================
                $totalRow = $lastRow + 1;

                $sheet->mergeCells("A{$totalRow}:B{$totalRow}");
                $sheet->setCellValue("A{$totalRow}", 'TOTAL SELURUH PEMINJAMAN');
                $sheet->setCellValue("C{$totalRow}", $this->totalPeminjaman);

                $sheet->getStyle("A{$totalRow}:C{$totalRow}")->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // =============================
                // FOOTER / TTD
                // =============================
                $row = $totalRow + 3;

                $sheet->mergeCells("B{$row}:C{$row}");
                $sheet->setCellValue("B{$row}", 'Mengetahui,');

                $row++;
                $sheet->mergeCells("B{$row}:C{$row}");
                $sheet->setCellValue("B{$row}", 'Penanggung Jawab Aset');

                $row += 3;
                $sheet->mergeCells("B{$row}:C{$row}");
                $sheet->setCellValue("B{$row}", '( ____________________ )');

                $row++;
                $sheet->mergeCells("B{$row}:C{$row}");
                $sheet->setCellValue(
                    "B{$row}",
                    'Tanggal: ' . now()->translatedFormat('d F Y')
                );
            },
        ];
    }
}
