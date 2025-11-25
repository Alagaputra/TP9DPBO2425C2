<?php
include_once("KontrakViewSirkuit.php");
include_once("models/Sirkuit.php");

class ViewSirkuit implements KontrakViewSirkuit {

    public function tampilSirkuit($listSirkuit): string {

        // Bangun isi tbody
        $tbody = '';
        $no = 1;
        foreach($listSirkuit as $s){
            $tbody .= '
            <tr>
               <td>'. $no .'</td>
               <td>'. htmlspecialchars($s->getNama()) .'</td>
               <td>'. htmlspecialchars($s->getLokasi()) .'</td>
               <td>'. htmlspecialchars($s->getPanjang()) .' km</td>
               <td>'. htmlspecialchars($s->getTikungan()) .'</td>
               <td class="col-actions">
                 <a href="index.php?nav=sirkuit&screen=edit&id='.$s->getId().'" class="btn btn-edit">Edit</a>
                 <button data-id="'.$s->getId().'" class="btn btn-delete">Hapus</button>
               </td>
            </tr>';
            $no++;
        }

        // Load template
        $template = file_get_contents(__DIR__ . '/../template/skin.html');

        // Ubah judul & text
        $template = str_replace('Daftar Pembalap', 'Daftar Sirkuit', $template);
        $template = str_replace('Pembalap — Daftar', 'Sirkuit — Daftar', $template);
        $template = str_replace('+ Tambah Pembalap', '+ Tambah Sirkuit', $template);
        $template = str_replace('href="index.php?screen=add"', 'href="index.php?nav=sirkuit&screen=add"', $template);

        // Replace header tabel
        $template = preg_replace(
            '/<th class="col-id">No<\/th>.*?<th class="col-actions">Aksi<\/th>/s',
            '
            <th class="col-id">No</th>
            <th>Nama Sirkuit</th>
            <th>Lokasi</th>
            <th>Panjang (km)</th>
            <th>Tikungan</th>
            <th class="col-actions">Aksi</th>',
            $template
        );

        // 🚀 REPLACE YG PENTING — inject tbody
        $template = str_replace(
            '<!-- PHP will inject rows here -->',
            $tbody,
            $template
        );

        // Update total
        $template = str_replace('Total:', 'Total: '.count($listSirkuit), $template);

        return $template;
    }



    public function tampilFormSirkuit($data = null): string {

        $template = file_get_contents(__DIR__ . '/../template/form.html');

        $template = str_replace('Form Pembalap', 'Form Sirkuit', $template);
        $template = str_replace('action="index.php"', 'action="index.php?nav=sirkuit"', $template);

        $fields = '
        <div><label>Nama Sirkuit</label><input name="nama" type="text" required value="'.($data['nama']??'').'"></div>
        <div><label>Lokasi</label><input name="lokasi" type="text" required value="'.($data['lokasi']??'').'"></div>
        <div><label>Panjang (km)</label><input name="panjang" type="number" step="0.01" value="'.($data['panjang']??'').'"></div>
        <div><label>Jumlah Tikungan</label><input name="tikungan" type="number" value="'.($data['jumlahTikungan']??'').'"></div>
        ';

        $formContent = '
        <form method="post" action="index.php?nav=sirkuit">
            <input type="hidden" name="action" value="'.($data ? 'edit' : 'add').'">
            <input type="hidden" name="id" value="'.($data['id']??'').'">

            '.$fields.'

            <div class="full actions">
                <a href="index.php?nav=sirkuit" class="btn btn-muted">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>';

        // replace form lama
        $cleanTemplate = preg_replace('/<form[\s\S]*?<\/form>/', $formContent, $template);

        return $cleanTemplate;
    }
}
?>
