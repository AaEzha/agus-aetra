<?php
if(!isset($_GET['a'])){
?>
	<?=tabel();?>
	<h3>Data Pemasangan <small>| <a href="?hal=pemasangan&a=tambah">Tambah Pemasangan</a></small></h3>
	<table id="tbl" class="centered">
		<thead>
			<tr>
				<th data-field="id" width="10%">No</th>
				<th data-field="nama">Nama Pemasang</th>
				<th data-field="kecl">Kec/Kel</th>
				<th data-field="status">Status</th>
				<th data-field="tgl">Tanggal Daftar</th>
				<th data-field="aksi" width="20%">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php
		$qu = $db->query("
							select 
							b.nama, b.id as idbio,
							p.kec, p.kel, p.dipasang, p.wktcrt, p.id as idpasang
							from biodata b 
							join pasang p
							on b.id=p.idbiodata where b.hapus='0'
							order by dipasang asc");
		$i=1;
		while($d = $qu->fetch_array()){ ?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$d['nama'];?></td>
				<td><?=ambildata($d['kec'],'kecamatan','nama');?>/<?=ambildata($d['kel'],'desa','nama');?></td>
				<td><?=$a=($d['dipasang']==0)?'Belum Dipasang':'Sudah Dipasang';?></td>
				<td><?=$d['wktcrt'];?></td>
				<td><a href="?hal=detailpemasangan&a=ubah&p=<?=$d['idpasang'];?>&b=<?=$d['idbio'];?>">Lihat</a></td>
			</tr>
		<?php $i++; } ?>
		</tbody>
	</table>
<?php
}
?>