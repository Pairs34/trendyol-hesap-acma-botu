<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">

                    <table class="table table-hover table-bordered text-center" id="sampleTable">

                        <thead>
                        <tr>
                            <th>Resim</th>
                            <th>Başlık</th>
                            <th>Link</th>
                            <th>Tarih</th>
                            <th>Gönderim</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($veriler as $veri):?>
                            <tr>
                                <td><img src="<?=$veri->resim?>" height="50" width="50"></td>
                                <td><?=$veri->baslik?></td>
                                <td><?=$veri->link?></td>
                                <td><?=explode("T",$veri->date)[0]?></td>
                                <td><?=$veri->submit == 0 ? '<span class="badge badge-danger">Yapılmadı</span>' : '<span class="badge badge-success">Yapıldı</span>'?></td>



                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>