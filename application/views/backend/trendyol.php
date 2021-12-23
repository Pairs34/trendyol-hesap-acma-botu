<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center" id="sampleTable">

                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>Şifre</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($hesaplar as $hesap):?>
                            <tr class="font-weight-bold">
                                <td><?=$hesap->email?></td>
                                <td><?=$hesap->password?></td>
                                <td>
                                    <a href="<?=route('trendyol.delete',["id" => $hesap->hesap_id])?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>

                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>