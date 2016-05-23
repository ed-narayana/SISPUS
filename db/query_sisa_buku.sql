SELECT	b.id_buku,
	(b.jumlah_buku - IFNULL(t.jml_buku,0)) AS sisa
FROM buku AS b
LEFT JOIN
(
SELECT	id_buku, SUM(detail_transaksi.jumlah_buku) AS jml_buku
	FROM detail_transaksi
	LEFT JOIN master_transaksi USING(id_master_transaksi)
	WHERE master_transaksi.status = 0
	GROUP BY id_buku
) AS t ON b.id_buku = t.id_buku;