<?php
// genetic_schedule.php - versi final dengan generasi otomatis

// Jadwal praktik tetap (per dokter)
$jadwal_dokter = [
    "D01" => [
        ["hari" => "Selasa", "jam" => "10:00-15:30"],
        ["hari" => "Rabu",   "jam" => "10:00-15:30"],
        ["hari" => "Sabtu",  "jam" => "10:00-15:30"]
    ],
    "D02" => [
        ["hari" => "Selasa", "jam" => "15:30-20:00"],
        ["hari" => "Kamis",  "jam" => "10:00-15:00"],
        ["hari" => "Jumat",  "jam" => "10:00-20:00"],
        ["hari" => "Minggu", "jam" => "10:00-20:00"]
    ],
    "D03" => [
        ["hari" => "Rabu",   "jam" => "15:30-20:00"],
        ["hari" => "Kamis",  "jam" => "15:00-20:00"],
        ["hari" => "Sabtu",  "jam" => "15:30-20:00"]
    ],
    "D04" => [
        ["hari" => "Senin",  "jam" => "10:00-14:00"]
    ]
];

// Daftar awal populasi
$populasi = [
    [
        ["pasien" => "P001", "dokter" => "D01", "hari" => "Selasa", "jam" => "10:00"],
        ["pasien" => "P002", "dokter" => "D02", "hari" => "Kamis",  "jam" => "11:00"],
        ["pasien" => "P003", "dokter" => "D03", "hari" => "Sabtu",  "jam" => "16:00"]
    ],
    [
        ["pasien" => "P001", "dokter" => "D02", "hari" => "Jumat",  "jam" => "14:00"],
        ["pasien" => "P002", "dokter" => "D01", "hari" => "Rabu",   "jam" => "11:00"],
        ["pasien" => "P003", "dokter" => "D04", "hari" => "Senin",  "jam" => "11:00"]
    ],
    [
        ["pasien" => "P001", "dokter" => "D03", "hari" => "Kamis",  "jam" => "16:00"],
        ["pasien" => "P002", "dokter" => "D02", "hari" => "Minggu", "jam" => "12:00"],
        ["pasien" => "P003", "dokter" => "D01", "hari" => "Sabtu",  "jam" => "11:00"]
    ]
];

function hitungFitness($kromosom, $jadwal_dokter) {
    $fitness = 0;
    foreach ($kromosom as $jadwal) {
        $dokter = $jadwal["dokter"];
        $hari = $jadwal["hari"];
        $jam_pasien = $jadwal["jam"];
        $valid = false;
        foreach ($jadwal_dokter[$dokter] as $slot) {
            if ($slot["hari"] === $hari) {
                [$jam_mulai, $jam_selesai] = explode("-", $slot["jam"]);
                if ($jam_pasien >= $jam_mulai && $jam_pasien <= $jam_selesai) {
                    $valid = true;
                    break;
                }
            }
        }
        if ($valid) {
            $fitness++;
        }
    }
    return $fitness;
}

function crossover($parent1, $parent2) {
    $point = rand(1, count($parent1) - 1);
    return array_merge(array_slice($parent1, 0, $point), array_slice($parent2, $point));
}

function mutasi($kromosom, $dokter_list, $hari_list, $jam_list) {
    $index = rand(0, count($kromosom) - 1);
    $kromosom[$index]['dokter'] = $dokter_list[array_rand($dokter_list)];
    $kromosom[$index]['hari'] = $hari_list[array_rand($hari_list)];
    $kromosom[$index]['jam'] = $jam_list[array_rand($jam_list)];
    return $kromosom;
}

$dokter_list = array_keys($jadwal_dokter);
$hari_list = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
$jam_list = ["10:00", "11:00", "14:00", "15:00", "16:00", "17:00"];

// Simulasi 10 generasi
for ($gen = 1; $gen <= 10; $gen++) {
    usort($populasi, function($a, $b) use ($jadwal_dokter) {
        return hitungFitness($b, $jadwal_dokter) <=> hitungFitness($a, $jadwal_dokter);
    });

    $anak = crossover($populasi[0], $populasi[1]);
    $anak = mutasi($anak, $dokter_list, $hari_list, $jam_list);

    $populasi[2] = $anak; // Ganti kromosom terburuk
}

$final_terbaik = $populasi[0];
$fitness_akhir = hitungFitness($final_terbaik, $jadwal_dokter);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Simulasi Jadwal - Generasi Terakhir</title>
    <style>
        table { border-collapse: collapse; width: 70%; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <h2>Generasi ke-10: Jadwal Terbaik (Fitness = <?= $fitness_akhir ?>)</h2>
    <table>
        <tr><th>Pasien</th><th>Dokter</th><th>Hari</th><th>Jam</th></tr>
        <?php foreach ($final_terbaik as $j): ?>
        <tr>
            <td><?= $j['pasien'] ?></td>
            <td><?= $j['dokter'] ?></td>
            <td><?= $j['hari'] ?></td>
            <td><?= $j['jam'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
