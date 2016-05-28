<?php

namespace App\Models\Mst;
use App\Models\Ref\Produk as refProduk;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'mst_produk';
    protected $fillable = ['nama', 'ref_produk_id', 'keterangan', 'mst_cabang_id',
                            'sku', 'barcode', 'harga_beli', 'harga_jual', 
                            'harga_reseller', 'stok_barang'];

    protected $appends = ['fk__ref_produk', 'fk__mst_cabang'];



    public function getFkMstCabangAttribute()
    {
    	$cb_obj = app('App\Repositories\Contracts\Mst\CabangRepoInterface');
    	$cb = $cb_obj->find($this->attributes['mst_cabang_id']);
    	if(count($cb)>0){
    		return $cb->nama;
    	}
    	return '-kosong-';
    }


    public function getFkRefProdukAttribute()
    {
    	$rp_obj = app('App\Repositories\Contracts\Ref\ProdukRepoInterface');
    	$rp = $rp_obj->find($this->attributes['ref_produk_id']);
    	if(count($rp)>0){
    		return $rp->nama;
    	}
    	return '-kosong-';
    }


    public function ref_produk()
    {
    	return $this->belongsTo(refProduk::class, 'ref_produk_id');
    }
}
