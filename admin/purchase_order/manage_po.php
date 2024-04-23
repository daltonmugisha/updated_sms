<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT p.*,s.name as supplier FROM purchase_order_list p inner join supplier_list s on p.supplier_id = s.id  where p.id = '{$_GET['id']}'");
    if($qry->num_rows >0){
        foreach($qry->fetch_array() as $k => $v){
            $$k = $v;
        }
    }
}
?>
<style>
    select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h4 class="card-title"><?php echo isset($id) ? "Purchase Order Details - ".$po_code : 'Create New Purchase Order' ?></h4>
    </div>
    <div class="card-body">
        <form action="" id="po-form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label text-info">P.O. Code</label>
                        <input type="text" class="form-control form-control-sm rounded-0" value="<?php echo isset($po_code) ? $po_code : '' ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="supplier_id" class="control-label text-info">Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="custom-select select2">
                            <option <?php echo !isset($supplier_id) ? 'selected' : '' ?> disabled></option>
                            <?php 
                            $supplier = $conn->query("SELECT * FROM `supplier_list` where status = 1 order by `name` asc");
                            while($row=$supplier->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['id'] ?>" <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? "selected" : "" ?> ><?php echo $row['name'] ?></option>
                            <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <fieldset>
                    <legend class="text-info">Item Form</legend>
                    <div class="row justify-content-center align-items-end">
                            <?php 
                                $item_arr = array();
                                $cost_arr = array();
                                $item = $conn->query("SELECT * FROM `item_list` where status = 1 order by `name` asc");
                                while($row=$item->fetch_assoc()):
                                    $item_arr[$row['supplier_id']][$row['id']] = $row;
                                    $cost_arr[$row['id']] = $row['cost'];
                                endwhile;
                            ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="item_id" class="control-label">Item</label>
                                <select  id="item_id" class="custom-select ">
                                    <option disabled selected></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                        
                            <div class="form-group">
                            <label for="supplier_id" class="control-label ">Quantity</label>
                            <select  id="unit" class="custom-select select2">
                            <?php 
                            $supplier = $conn->query("SELECT * FROM `unit` ");
                            while($row=$supplier->fetch_assoc()):
                            ?>
                            <option ><?php echo $row['unit_name'] ?></option>
                            <?php endwhile; ?>                       

                            </select>
                        </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty" class="control-label">Qty</label>
                                <input type="number" step="any" class="form-control rounded-0" id="qty">
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="form-group">
                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="add_to_list">Add to List</button>
                            </div>
                        </div>
                </fieldset>
                <hr>
                <table class="table table-striped table-bordered" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr class="text-light bg-navy">
                            <th class="text-center py-1 px-2"></th>
                            <th class="text-center py-1 px-2">Qty</th>
                            <th class="text-center py-1 px-2">Unit</th>
                            <th class="text-center py-1 px-2">Item</th>
                            <th class="text-center py-1 px-2">Cost</th>
                            <th class="text-center py-1 px-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        if(isset($id)):
                        $qry = $conn->query("SELECT p.*,i.name,i.description FROM `po_items` p inner join item_list i on p.item_id = i.id where p.po_id = '{$id}'");
                        while($row = $qry->fetch_assoc()):
                            $total += $row['total']
                        ?>
                        <tr>
                            <td class="py-1 px-2 text-center">
                                <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
                            </td>
                            <td class="py-1 px-2 text-center qty">
                                <span class="visible"><?php echo number_format($row['quantity']); ?></span>
                                <input type="hidden" name="item_id[]" value="<?php echo $row['item_id']; ?>">
                                <input type="hidden" name="unit[]" value="<?php echo $row['unit']; ?>">
                                <input type="hidden" name="qty[]" value="<?php echo $row['quantity']; ?>">
                                <input type="hidden" name="price[]" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="total[]" value="<?php echo $row['total']; ?>">
                            </td>
                            <td class="py-1 px-2 text-center unit">
                            <?php echo $row['unit']; ?>
                            </td>
                            <td class="py-1 px-2 item">
                            <?php echo $row['name']; ?> <br>
                            <?php echo $row['description']; ?>
                            </td>
                            <td class="py-1 px-2 text-right cost">
                            <?php echo number_format($row['price']); ?>
                            </td>
                            <td class="py-1 px-2 text-right total">
                            <?php echo number_format($row['total']); ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Sub Total</th>
                            <th class="text-right py-1 px-2 sub-total">0</th>
                        </tr>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Discount <input style="width:40px !important" name="discount_perc" class='' type="number" min="0" max="100" value="<?php echo isset($discount_perc) ? $discount_perc : 0 ?>">%
                                <input type="hidden" name="discount" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 discount"><?php echo isset($discount) ? number_format($discount) : 0 ?></th>
                        </tr>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Tax <input style="width:40px !important" name="tax_perc" class='' type="number" min="0" max="100" value="<?php echo isset($tax_perc) ? $tax_perc : 0 ?>">%
                                <input type="hidden" name="tax" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 tax"><?php echo isset($tax) ? number_format($tax) : 0 ?></th>
                        </tr>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Total
                                <input type="hidden" name="amount" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 grand-total">0</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarks" class="text-info control-label">Remarks</label>
                            <textarea name="remarks" id="remarks" rows="3" class="form-control rounded-0"><?php echo isset($remarks) ? $remarks : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-primary" type="submit" form="po-form">Save</button>
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=purchase_order' ?>">Cancel</a>
    </div>
</div>
<table id="clone_list" class="d-none">
    <tr>
        <td class="py-1 px-2 text-center">
            <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="py-1 px-2 text-center qty">
            <span class="visible"></span>
            <input type="hidden" name="item_id[]">
            <input type="hidden" name="unit[]">
            <input type="hidden" name="qty[]">
            <input type="hidden" name="price[]">
            <input type="hidden" name="total[]">
        </td>
        <td class="py-1 px-2 text-center unit">
        </td>
        <td class="py-1 px-2 item">
        </td>
        <td class="py-1 px-2 text-right cost">
        </td>
        <td class="py-1 px-2 text-right total">
        </td>
    </tr>
</table>
<!-- <?php echo json_encode($item_arr) ?> -->
<script>
    var items = <?php echo json_encode($item_arr)  ?>;
    var costs = $.parseJSON('<?php echo json_encode($cost_arr) ?>')
    
    $(function(){
        $('.select2').select2({
            placeholder:"Please select here",
            width:'resolve',
        })
        $('#item_id').select2({
            placeholder:"Please select supplier first",
            width:'resolve',
        })

        $('#supplier_id').change(function(){
            var supplier_id = $(this).val()
            $('#item_id').select2('destroy')
            if(!!items[supplier_id]){
                $('#item_id').html('')
                var list_item = new Promise(resolve=>{
                    Object.keys(items[supplier_id]).map(function(k){
                        var row = items[supplier_id][k]
                        var opt = $('<option>')
                            opt.attr('value',row.id)
                            opt.text(row.name)
                        $('#item_id').append(opt)
                    })
                    resolve()
                })
                list_item.then(function(){
                    $('#item_id').select2({
                        placeholder:"Please select item here",
                        width:'resolve',
                    })
                })
            }else{
                list_item.then(function(){
                    $('#item_id').select2({
                        placeholder:"No Items Listed yet",
                        width:'resolve',
                        
                    })
                })
            }

        })

        $('#add_to_list').click(function(){
            var supplier = $('#supplier_id').val()
            var item = $('#item_id').val()
            var qty = $('#qty').val() > 0 ? $('#qty').val() : 0;
            var unit = $('#unit').val()
            var price = costs[item] || 0
            var total = parseFloat(qty) *parseFloat(price)
            // console.log(supplier,item)
            var item_name = items[supplier][item].name || 'N/A';
            var item_description = items[supplier][item].description || 'N/A';
            var tr = $('#clone_list tr').clone()
            if(item == '' || qty == '' || unit == '' ){
                alert_toast('Form Item textfields are required.','warning');
                return false;
            }
            if($('table#list tbody').find('tr[data-id="'+item+'"]').length > 0){
                alert_toast('Item is already exists on the list.','error');
                return false;
            }
            tr.find('[name="item_id[]"]').val(item)
            tr.find('[name="unit[]"]').val(unit)
            tr.find('[name="qty[]"]').val(qty)
            tr.find('[name="price[]"]').val(price)
            tr.find('[name="total[]"]').val(total)
            tr.attr('data-id',item)
            tr.find('.qty .visible').text(qty)
            tr.find('.unit').text(unit)
            tr.find('.item').html(item_name+'<br/>'+item_description)
            tr.find('.cost').text(parseFloat(price).toLocaleString('en-US'))
            tr.find('.total').text(parseFloat(total).toLocaleString('en-US'))
            $('table#list tbody').append(tr)
            calc()
            $('#item_id').val('').trigger('change')
            $('#qty').val('')
            $('#unit').val('')
            tr.find('.rem_row').click(function(){
                rem($(this))
            })
            
            $('[name="discount_perc"],[name="tax_perc"]').on('input',function(){
                calc()
            })
            $('#supplier_id').attr('readonly','readonly')
        })
        $('#po-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_po",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(resp.status == 'success'){
						location.replace(_base_url_+"admin/?page=purchase_order/view_po&id="+resp.id);
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
                    $('html,body').animate({scrollTop:0},'fast')
				}
			})
		})

        if('<?php echo isset($id) && $id > 0 ?>' == 1){
            calc()
            $('#supplier_id').trigger('change')
            $('#supplier_id').attr('readonly','readonly')
            $('table#list tbody tr .rem_row').click(function(){
                rem($(this))
            })
        }
    })
    function rem(_this){
        _this.closest('tr').remove()
        calc()
        if($('table#list tbody tr').length <= 0)
            $('#supplier_id').removeAttr('readonly')

    }
    function calc(){
        var sub_total = 0;
        var grand_total = 0;
        var discount = 0;
        var tax = 0;
        $('table#list tbody input[name="total[]"]').each(function(){
            sub_total += parseFloat($(this).val())
            
        })
        $('table#list tfoot .sub-total').text(parseFloat(sub_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        var discount =   sub_total * (parseFloat($('[name="discount_perc"]').val()) /100)
        sub_total = sub_total - discount;
        var tax =   sub_total * (parseFloat($('[name="tax_perc"]').val()) /100)
        grand_total = sub_total + tax
        $('.discount').text(parseFloat(discount).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="discount"]').val(parseFloat(discount))
        $('.tax').text(parseFloat(tax).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="tax"]').val(parseFloat(tax))
        $('table#list tfoot .grand-total').text(parseFloat(grand_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="amount"]').val(parseFloat(grand_total))

    }
</script>


<!--     var items = $.parseJSON('{"1":{"34":{"id":"34","name":"Ace toilet clean ","description":"","supplier_id":"1","cost":"1600","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 15:07:42","cat_id":"0"},"28":{"id":"28","name":"Balais avec ramassettes ","description":"","supplier_id":"1","cost":"9000","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"38":{"id":"38","name":"Bottes SANDAK","description":"","supplier_id":"1","cost":"9000","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"37":{"id":"37","name":"COTEX (Allways or SUPA)","description":"","supplier_id":"1","cost":"35000","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"39":{"id":"39","name":"Eau min\u00e9rale INYANGE (Carton de 24 bouteilles) ","description":"","supplier_id":"1","cost":"4000","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"43":{"id":"43","name":"Ikawa ''Gorilla''","description":"","supplier_id":"1","cost":"9000","status":"1","date_created":"2024-01-04 14:26:57","date_updated":"2024-01-04 14:26:57","cat_id":"0"},"44":{"id":"44","name":"Ikibiriti ","description":"","supplier_id":"1","cost":"3000","status":"1","date_created":"2024-01-04 14:26:57","date_updated":"2024-01-04 14:26:57","cat_id":"0"},"23":{"id":"23","name":"Ikiringiti cya rufuku ","description":"","supplier_id":"1","cost":"6000","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"26":{"id":"26","name":"Ikiroso gifite umuhini n'amenyo magufi   KIAKA  ","description":"","supplier_id":"1","cost":"3000","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"36":{"id":"36","name":"Imbuma zo gushyira muri urinoir ","description":"","supplier_id":"1","cost":"3000","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"27":{"id":"27","name":"Imyeyo KIAKA  ","description":"","supplier_id":"1","cost":"3000","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"46":{"id":"46","name":"Ingorofani (Chilington)","description":"","supplier_id":"1","cost":"60000","status":"1","date_created":"2024-01-04 14:26:57","date_updated":"2024-01-04 14:26:57","cat_id":"0"},"47":{"id":"47","name":"Ipompo yo gutera umuti wica udukoko","description":"","supplier_id":"1","cost":"35000","status":"1","date_created":"2024-01-04 14:26:57","date_updated":"2024-01-04 14:26:57","cat_id":"0"},"17":{"id":"17","name":"Isabune y'ifu yo mudushashi ","description":"","supplier_id":"1","cost":"7500","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"19":{"id":"19","name":"Isabune yo gukaraba (Sant\u00e9)","description":"","supplier_id":"1","cost":"18500","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"18":{"id":"18","name":"Isabune yo kumesa (GIFURA)","description":"","supplier_id":"1","cost":"12000","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"16":{"id":"16","name":"Isukari ","description":"","supplier_id":"1","cost":"96000","status":"1","date_created":"2024-01-04 14:26:54","date_updated":"2024-01-04 14:26:54","cat_id":"0"},"45":{"id":"45","name":"Lait en poudre (Star)","description":"","supplier_id":"1","cost":"198000","status":"1","date_created":"2024-01-04 14:26:57","date_updated":"2024-01-04 14:26:57","cat_id":"0"},"31":{"id":"31","name":"Papiers hygi\u00e8niques (SUPA)","description":"","supplier_id":"1","cost":"10500","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"35":{"id":"35","name":"Parfum pour les toilettes ","description":"","supplier_id":"1","cost":"2000","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"33":{"id":"33","name":"Pleidge ","description":"","supplier_id":"1","cost":"4500","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"25":{"id":"25","name":"Poubelle 20Litres  ipfundikirwa ya alminium ","description":"","supplier_id":"1","cost":"63000","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"24":{"id":"24","name":"Poubelles ntoya ya plastique yo mu biro ","description":"","supplier_id":"1","cost":"3000","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"29":{"id":"29","name":"Raclette KIAKA","description":"","supplier_id":"1","cost":"3000","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"41":{"id":"41","name":"Rwanda Tea ","description":"","supplier_id":"1","cost":"1800","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"20":{"id":"20","name":"Savon liquide ","description":"","supplier_id":"1","cost":"15000","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"40":{"id":"40","name":"Serviettes (SUPA)","description":"","supplier_id":"1","cost":"6000","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"22":{"id":"22","name":"Shinex yo koza ibirahure ","description":"","supplier_id":"1","cost":"11754","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"},"42":{"id":"42","name":"Tea bag ","description":"","supplier_id":"1","cost":"2500","status":"1","date_created":"2024-01-04 14:26:57","date_updated":"2024-01-04 14:26:57","cat_id":"0"},"30":{"id":"30","name":"Uburoso bwo koza W.C biracaraho  ","description":"","supplier_id":"1","cost":"2500","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"32":{"id":"32","name":"Udusume turinganiye two guhanaguza ","description":"","supplier_id":"1","cost":"3500","status":"1","date_created":"2024-01-04 14:26:56","date_updated":"2024-01-04 14:26:56","cat_id":"0"},"48":{"id":"48","name":"Umuti wica udukoko ","description":"","supplier_id":"1","cost":"10000","status":"1","date_created":"2024-01-04 14:26:57","date_updated":"2024-01-04 14:26:57","cat_id":"0"},"21":{"id":"21","name":"VIM VIM","description":"","supplier_id":"1","cost":"20000","status":"1","date_created":"2024-01-04 14:26:55","date_updated":"2024-01-04 14:26:55","cat_id":"0"}},"2":{"77":{"id":"77","name":"Agenda moyenne (sans ann\u00e9e) ","description":"","supplier_id":"2","cost":"3500","status":"1","date_created":"2024-01-17 07:03:51","date_updated":"2024-01-17 07:03:51","cat_id":"2"},"63":{"id":"63","name":"Agraffe ","description":"","supplier_id":"2","cost":"1500","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"70":{"id":"70","name":"Bics bleus ","description":"","supplier_id":"2","cost":"7500","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"71":{"id":"71","name":"Bics rouges ","description":"","supplier_id":"2","cost":"7500","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"66":{"id":"66","name":"Bloc notes petit format","description":"","supplier_id":"2","cost":"400","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"73":{"id":"73","name":"Bo\u00eete d'archive ","description":"","supplier_id":"2","cost":"2500","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"57":{"id":"57","name":"Cahiers de 200 pages ","description":"","supplier_id":"2","cost":"68000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"58":{"id":"58","name":"Cahiers de coupe de 96 pages ","description":"","supplier_id":"2","cost":"65000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"78":{"id":"78","name":"Ciseaux de bureau ","description":"","supplier_id":"2","cost":"1000","status":"1","date_created":"2024-01-17 07:03:51","date_updated":"2024-01-17 07:03:51","cat_id":"2"},"79":{"id":"79","name":"Colle Fantastic","description":"","supplier_id":"2","cost":"12000","status":"1","date_created":"2024-01-17 07:03:51","date_updated":"2024-01-17 07:03:51","cat_id":"2"},"80":{"id":"80","name":"Colle UHU liquide ","description":"","supplier_id":"2","cost":"9500","status":"1","date_created":"2024-01-17 07:03:51","date_updated":"2024-01-17 07:03:51","cat_id":"2"},"55":{"id":"55","name":"Craie blanche (MUNGYO)","description":"","supplier_id":"2","cost":"40000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"56":{"id":"56","name":"Craie de couleur (MUNGYO)","description":"","supplier_id":"2","cost":"52000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"53":{"id":"53","name":"Encre \u00e0 huile pour cachet automatique (Blue) ","description":"","supplier_id":"2","cost":"4000","status":"1","date_created":"2024-01-17 07:03:49","date_updated":"2024-01-17 07:03:49","cat_id":"2"},"54":{"id":"54","name":"Encre \u00e0 huile pour cachet automatique (Rouge) ","description":"","supplier_id":"2","cost":"4000","status":"1","date_created":"2024-01-17 07:03:49","date_updated":"2024-01-17 07:03:49","cat_id":"2"},"62":{"id":"62","name":"Encre correcteur (BLANCO)","description":"","supplier_id":"2","cost":"1500","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"59":{"id":"59","name":"Enveloppes A4","description":"","supplier_id":"2","cost":"4000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"72":{"id":"72","name":"Farde \u00e0 suspendre de 25pc\u00e8s ","description":"","supplier_id":"2","cost":"9500","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"76":{"id":"76","name":"Ibifuniko  by'amakayi ","description":"","supplier_id":"2","cost":"400","status":"1","date_created":"2024-01-17 07:03:51","date_updated":"2024-01-17 07:03:51","cat_id":"2"},"64":{"id":"64","name":"Isumaku zifata kuri white board ","description":"","supplier_id":"2","cost":"4800","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"81":{"id":"81","name":"Labels paper ","description":"","supplier_id":"2","cost":"20000","status":"1","date_created":"2024-01-17 07:03:51","date_updated":"2024-01-17 07:03:51","cat_id":"2"},"68":{"id":"68","name":"Marqueurs pour white board","description":"","supplier_id":"2","cost":"1000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"52":{"id":"52","name":"Papier bristol ( Bleu) A4","description":"","supplier_id":"2","cost":"5000","status":"1","date_created":"2024-01-17 07:03:49","date_updated":"2024-01-17 07:03:49","cat_id":"2"},"75":{"id":"75","name":"Papiers chemises (50pcs rose + 50 pcs vert) ","description":"","supplier_id":"2","cost":"9000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"50":{"id":"50","name":"Papiers duplicata (Marque REPORT)","description":"","supplier_id":"2","cost":"27000","status":"1","date_created":"2024-01-17 07:03:49","date_updated":"2024-01-17 07:03:49","cat_id":"2"},"65":{"id":"65","name":"Perforateur ","description":"","supplier_id":"2","cost":"5000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"67":{"id":"67","name":"Permanent marker (Petit format)","description":"","supplier_id":"2","cost":"5000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"60":{"id":"60","name":"Petites enveloppes blanches ","description":"","supplier_id":"2","cost":"1500","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"61":{"id":"61","name":"Post it ","description":"","supplier_id":"2","cost":"4500","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"51":{"id":"51","name":"PVC pour faire les cartes d'\u00e9l\u00e8vrs EPSON","description":"","supplier_id":"2","cost":"35000","status":"1","date_created":"2024-01-17 07:03:49","date_updated":"2024-01-17 07:03:49","cat_id":"2"},"74":{"id":"74","name":"Skotches durs (Pelicaline) pour la reliure des livres ","description":"","supplier_id":"2","cost":"2000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"},"69":{"id":"69","name":"Souligneur ","description":"","supplier_id":"2","cost":"2000","status":"1","date_created":"2024-01-17 07:03:50","date_updated":"2024-01-17 07:03:50","cat_id":"2"}},"4":{"84":{"id":"84","name":"Jezz z abakinnyi bo mu kibuga hagati","description":"","supplier_id":"4","cost":"289000","status":"1","date_created":"2024-01-17 07:10:34","date_updated":"2024-01-17 07:10:34","cat_id":"17"}}}')
 -->