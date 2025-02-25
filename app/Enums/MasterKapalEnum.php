<?php

namespace App\Enums;

enum MasterKapalEnum: string
{
    const PENUMPANG = 'Kapal Penumpang';
    const BARANG = 'Kapal Barang';
    const PERINTIS = 'Kapal Perintis';
    const REDE = 'Kapal Rede';

    public static function getKategoriKapal(): array
    {
        return [
            self::PENUMPANG,
            self::BARANG,
            self::PERINTIS,
            self::REDE,
        ];
    }
}
