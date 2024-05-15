CREATE TABLE Penumpang_Kapal (
    ID INT PRIMARY KEY,
    KAPAL VARCHAR(50),
    PELAYARAN VARCHAR(50),
    PENUMPANG VARCHAR(50),
    ASAL VARCHAR(50),
    TUJUAN VARCHAR(50),
    TGL_BERANGKAT DATE
);


INSERT INTO Penumpang_Kapal (ID, KAPAL, PELAYARAN, PENUMPANG, ASAL, TUJUAN, TGL_BERANGKAT) VALUES
(1, 'LABOBAR', 'PELNI', 'MAYA', 'TJ PRIOK', 'TJ PERAK', '2024-01-01'),
(2, 'LABOBAR', 'PELNI', 'EKA', 'TJ PRIOK', 'MAKASSAR', '2024-01-01'),
(3, 'LABOBAR', 'PELNI', 'ASRI', 'TJ PRIOK', 'MAKASSAR', '2024-01-01'),
(4, 'LABOBAR', 'PELNI', 'JONI', 'TJ PRIOK', 'AMBON', '2024-01-01'),
(5, 'LABOBAR', 'PELNI', 'BUDI', 'TJ PRIOK', 'TJ PERAK', '2024-01-01'),
(6, 'LABOBAR', 'PELNI', 'ADE', 'TJ PRIOK', 'TJ PERAK', '2024-01-01'),
(7, 'LABOBAR', 'PELNI', 'JAMAL', 'TJ PRIOK', 'AMBON', '2024-01-01'),
(8, 'LABOBAR', 'PELNI', 'SAHAL', 'TJ PRIOK', 'AMBON', '2024-01-01'),
(9, 'LABOBAR', 'PELNI', 'ANDI', 'TJ PRIOK', 'AMBON', '2024-01-01'),
(10, 'LABOBAR', 'PELNI', 'NAWI', 'TJ PRIOK', 'MAKASSAR', '2024-01-01'),
(11, 'LABOBAR', 'PELNI', 'RINA', 'TJ PRIOK', 'TJ PERAK', '2024-01-01'),
(12, 'FERRY UTAMA', 'DLN', 'BAGAS', 'TJ PRIOK', 'BELAWAN', '2024-01-01'),
(13, 'FERRY UTAMA', 'DLN', 'SYAM', 'TJ PRIOK', 'BELAWAN', '2024-01-01'),
(14, 'FERRY UTAMA', 'DLN', 'DONI', 'TJ PRIOK', 'BELAWAN', '2024-01-01'),
(15, 'FERRY UTAMA', 'DLN', 'JALAL', 'TJ PRIOK', 'BELAWAN', '2024-01-01'),
(16, 'FERRY UTAMA', 'DLN', 'BUNGA', 'TJ PRIOK', 'BATAM', '2024-01-01'),
(17, 'FERRY UTAMA', 'DLN', 'NURI', 'TJ PRIOK', 'BATAM', '2024-01-01');

SELECT
    KAPAL,
    PELAYARAN,
    (SELECT GROUP_CONCAT(DISTINCT TUJUAN ORDER BY TUJUAN SEPARATOR ', ')
     FROM Penumpang_Kapal AS sub
     WHERE sub.KAPAL = main.KAPAL AND sub.PELAYARAN = main.PELAYARAN AND sub.TGL_BERANGKAT = main.TGL_BERANGKAT
     GROUP BY KAPAL, PELAYARAN, TGL_BERANGKAT
    ) AS TUJUAN,
    TGL_BERANGKAT
FROM
    Penumpang_Kapal AS main
GROUP BY
    KAPAL, PELAYARAN, TGL_BERANGKAT;

SELECT
    KAPAL,
    PELAYARAN,
    TUJUAN,
    TGL_BERANGKAT,
    COUNT(*) AS JUMLAH_TIKET
FROM
    Penumpang_Kapal
WHERE
    TGL_BERANGKAT = '2024-01-01'
GROUP BY
    KAPAL, PELAYARAN, TUJUAN, TGL_BERANGKAT
ORDER BY
    KAPAL, TUJUAN;


CREATE TABLE Tabel (
    PREFIX VARCHAR(10),
    SEQUENCE INT,
    ID VARCHAR(20)
);

INSERT INTO Tabel (PREFIX, SEQUENCE) VALUES
('KAPAL', 21),
('PASS', 7),
('CAR', 303);

SELECT
    PREFIX,
    SEQUENCE,
    CONCAT(PREFIX, LPAD(SEQUENCE, 6, '0')) AS ID
FROM
    Tabel;
