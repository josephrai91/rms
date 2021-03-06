<?php
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			foreach ( $_POST as $key => $value ) {
				if( is_array( $_POST[$key] ) ){
					$_POST[$key] = implode( ' ', $_POST[$key] );
				}
			}
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				$x=editProduct($dbh, $post);
				if($x) $_SESSION['check']=$check;

			}

	}
}
/////////////////////////////////////////Fetch Part//////////////////////////////////////////////////////
if( isset($_GET['id']) ){
    $data = getProductDataSingle( $dbh, $_GET['id'] );
    if( $data ){
        foreach( $data as $key => $value ){
            $$key = $value;
        }
        $catData = getCategoryOptions( $dbh, $category_id );
        $disData = getDiscountOptions( $dbh, $discount );
        $taxData = getTaxOptions( $dbh, $tax );
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////
?>
        <div class="row">
            <div class="col-sm-12 sm-fifty">
                <div class="panel panel-default">
                    <div class="panel-heading"> <i class="clip-stats"></i> Edit Product
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                    </div>
                    <div class="panel-body">
                        <div class="flot-big-container">
                            <form action="./?option=editProduct<?php echo '&id='.$_GET['id']; ?>" role="form" class="smart-wizard form-horizontal" method="post" name="site_config"  enctype="multipart/form-data" accept-charset="utf-8" novalidate>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Product Name:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" name="pname" autocomplete="Off" tabindex="1" value="<?php echo $name;?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Slug:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" name="slug" autocomplete="Off" tabindex="1" value="<?php echo $slug;?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Price:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" name="price" autocomplete="Off" tabindex="1" value="<?php echo $price;?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Offer:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" name="offer" autocomplete="Off" tabindex="1" value="<?php echo $offer;?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Quantity:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" name="quantity" autocomplete="Off" tabindex="1" value="<?php echo $quantity;?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Category:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <select name="category_id" id="" class="form-control">
                                        <option value = "0"> No Category </option>
                                        <?php echo $catData;?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Applicable Tax:<font color="#ff0000">*</font> </label>
                                </div>

                                <?php echo $taxData;?>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Status:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="myfunnel-switch-light"  data-id="active" data-type="switch" type="checkbox"  value="1" <?php echo ( $active == 1 ) ? 'checked="checked"' : ''; ?>>
            			            			<input type="hidden" id="active" name="active" value="<?php echo $active ?>" />
                                  </div>
                                </div>
																<div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Discountable:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="myfunnel-switch-light" id="discountToggle"  data-target="discount_div" data-id="discountable" data-type="switch" type="checkbox"  value="1" <?php echo ( $discountable == 1 ) ? 'checked="checked"' : ''; ?>>
            			            			<input type="hidden" id="discountable" name="discountable" value="<?php echo $discountable ?>" />
                                  </div>
                                </div>
																<div class="form-group <?php echo ( $discountable ) ? '' : 'display-none'; ?>" id="discount_div" >
                                  <label class="col-sm-2 control-label" for="co_name">Discount:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
																		<select name="discount" id="discount" class="form-control">
                                        <option value = "0"> No Discount </option>
                                        <?php echo $disData;?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-5 text-right">
                                    <input type="hidden" value="<?php echo $_GET['id'];?>" name="id"/>
                                    <input type="hidden" value="<?php echo date("Y-m-d H:i:s");?>" name="date" id="" class=""/>
                                    <input class="btn btn-success" type="submit" name="submit" value="Confirm Edit">
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
