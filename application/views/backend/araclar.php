<div class="col-md-12">
    <div class="tile">
        <h3 class="tile-title">Uçak Modu Ayarları</h3>
        <div class="tile-body">
            <?= form_open(route('trendyol.ucak_guncelle'), ['class' => 'row']) ?>
            <div class="form-group col-md-4">
                <label class="control-label">X Ekseni</label>
                <input class="form-control" type="text" name="x" value="<?= $ucak_modu->x ?>">
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Y Ekseni</label>
                <input class="form-control" type="text" name="y" value="<?= $ucak_modu->y ?>">
            </div>
            <div class="form-group col-md-3 align-self-end">
                <button class="btn btn-primary" type="submit">Kaydet
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="tile">
        <h3 class="tile-title">Hesap Olustur</h3>
        <div class="tile-body">
            <?= form_open(route('trendyol.generate'), ['class' => 'row']) ?>
            <div class="form-group col-md-3">
                <label class="control-label">Hesap Şifresi</label>
                <input class="form-control" type="text" name="password">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Hesap Adedi</label>
                <input class="form-control" type="text" name="account_count">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Uçak Modu</label>
                <div class="toggle lg">
                    <label>
                        <input type="checkbox" name="ucak_mod" checked><span class="button-indecator"></span>
                    </label>
                </div>
            </div>
            <div class="form-group col-md-3 align-self-end">
                <button class="btn btn-primary" type="submit">Oluştur
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="tile">
        <h3 class="tile-title">Koleksiyon Kaydedici</h3>
        <span class="badge badge-success mb-1"><?= count($hesaplar) ?> Adet Hesap Var</span>
        <div class="tile-body">
            <?= form_open(route('trendyol.saveCollection'), ['class' => 'row']) ?>
            <div class="form-group col-md-3">
                <label class="control-label">Koleksiyon ID</label>
                <input class="form-control" type="text" name="collectionID">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Kaydetme Adedi</label>
                <input class="form-control" type="text" name="save_count">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Uçak Modu</label>
                <div class="toggle lg">
                    <label>
                        <input type="checkbox" name="ucak_mod" checked><span class="button-indecator"></span>
                    </label>
                </div>
            </div>
            <div class="form-group col-md-3 align-self-end">
                <button class="btn btn-primary" type="submit">Kaydet
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="tile">
        <h3 class="tile-title">Magaza Takipçi</h3>
        <span class="badge badge-success mb-1"><?= count($hesaplar) ?> Adet Hesap Var</span>
        <div class="tile-body">
            <?= form_open(route('trendyol.followSeller'), ['class' => 'row']) ?>
            <div class="form-group col-md-3">
                <label class="control-label">Mağaza ID</label>
                <input class="form-control" type="text" name="sellerID">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Takipçi Adedi</label>
                <input class="form-control" type="text" name="save_count">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Uçak Modu</label>
                <div class="toggle lg">
                    <label>
                        <input type="checkbox" name="ucak_mod" checked><span class="button-indecator"></span>
                    </label>
                </div>
            </div>
            <div class="form-group col-md-3 align-self-end">
                <button class="btn btn-primary" type="submit">Kaydet
                </button>
            </div>
            </form>
        </div>
    </div>
</div>