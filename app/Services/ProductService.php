<?php 
namespace App\Services;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;




class ProductService
{
    public function generateBarCode($data)
    {
       
        // Generate a barcode for the product
        $barcode = DNS1D::getBarcodeHTML($data['name'], 'C39');
        
        return $barcode;
    }


}

