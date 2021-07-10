
<?php $__env->startSection('content'); ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Group Permission')); ?></h4>
                    </div>
                    <?php echo Form::open(['route' => 'role.setPermission', 'method' => 'post']); ?>

                    <div class="card-body">
                    	<input type="hidden" name="role_id" value="<?php echo e($lims_role_data->id); ?>" />
						<div class="table-responsive">
						    <table class="table table-bordered permission-table">
						        <thead>
						        <tr>
						            <th colspan="5" class="text-center"><?php echo e($lims_role_data->name); ?> <?php echo e(trans('file.Group Permission')); ?></th>
						        </tr>
						        <tr>
						            <th rowspan="2" class="text-center">Module Name</th>
						            <th colspan="4" class="text-center">
						            	<div class="checkbox">
						            		<input type="checkbox" id="select_all">
						            		<label for="select_all"><?php echo e(trans('file.Permissions')); ?></label>
						            	</div>
						            </th>
						        </tr>
						        <tr>
						            <th class="text-center"><?php echo e(trans('file.View')); ?></th>
						            <th class="text-center"><?php echo e(trans('file.add')); ?></th>
						            <th class="text-center"><?php echo e(trans('file.edit')); ?></th>
						            <th class="text-center"><?php echo e(trans('file.delete')); ?></th>
						        </tr>
						        </thead>
						        <tbody>
						        <tr>
						            <td><?php echo e(trans('file.product')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("products-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="products-index" name="products-index" checked />
								                <?php else: ?>
								                <input type="checkbox" value="1" id="products-index" name="products-index" />
								                <?php endif; ?>
								                <label for="products-index"></label>
							            	</div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("products-add", $all_permission)): ?>
								               	<input type="checkbox" value="1" id="products-add" name="products-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="products-add" name="products-add">
								                <?php endif; ?>
								                <label for="products-add"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("products-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="products-edit" name="products-edit" checked />
								                <?php else: ?>
								                <input type="checkbox" value="1" id="products-edit" name="products-edit" />
								                <?php endif; ?>
								                <label for="products-edit"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("products-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="products-delete" name="products-delete" checked />
								                <?php else: ?>
								                <input type="checkbox" value="1" id="products-delete" name="products-delete" />
								                <?php endif; ?>
								                <label for="products-delete"></label>
							                </div>
							            </div>
						            </td>
						        </tr>

						        <tr>
						            <td><?php echo e(trans('file.Purchase')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("purchases-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="purchases-index" name="purchases-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="purchases-index" name="purchases-index">
								                <?php endif; ?>
								                <label for="purchases-index"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("purchases-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="purchases-add" name="purchases-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="purchases-add" name="purchases-add">
								                <?php endif; ?>
								                <label for="purchases-add"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("purchases-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="purchases-edit" name="purchases-edit" checked />
								                <?php else: ?>
								                <input type="checkbox" value="1" id="purchases-edit" name="purchases-edit">
								                <?php endif; ?>
								                <label for="purchases-edit"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("purchases-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="purchases-delete" name="purchases-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="purchases-delete" name="purchases-delete">
								                <?php endif; ?>
								                <label for="purchases-delete"></label>
							            	</div>
						            	</div>
						            </td>
						        </tr>

						        <tr>
						            <td><?php echo e(trans('file.Sale')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("sales-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="sales-index" name="sales-index" checked />
								                <?php else: ?>
								                <input type="checkbox" value="1" id="sales-index" name="sales-index">
								                <?php endif; ?>
								                <label for="sales-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("sales-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="sales-add" name="sales-add" checked />
								                <?php else: ?>
								                <input type="checkbox" value="1" id="sales-add" name="sales-add">
								                <?php endif; ?>
								                <label for="sales-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("sales-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="sales-edit" name="sales-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="sales-edit" name="sales-edit">
								                <?php endif; ?>
								                <label for="sales-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("sales-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="sales-delete" name="sales-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="sales-delete" name="sales-delete">
								                <?php endif; ?>
								                <label for="sales-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>

						        <tr>
						            <td><?php echo e(trans('file.Expense')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("expenses-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="expenses-index" name="expenses-index" checked />
								                <?php else: ?>
								                <input type="checkbox" value="1" id="expenses-index" name="expenses-index">
								                <?php endif; ?>
								                <label for="expenses-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("expenses-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="expenses-add" name="expenses-add" checked />
								                <?php else: ?>
								                <input type="checkbox" value="1" id="expenses-add" name="expenses-add">
								                <?php endif; ?>
								                <label for="expenses-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("expenses-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="expenses-edit" name="expenses-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="expenses-edit" name="expenses-edit">
								                <?php endif; ?>
								                <label for="expenses-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("expenses-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="expenses-delete" name="expenses-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="expenses-delete" name="expenses-delete">
								                <?php endif; ?>
								                <label for="expenses-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>

						        <tr>
						            <td><?php echo e(trans('file.Quotation')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("quotes-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="quotes-index" name="quotes-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="quotes-index" name="quotes-index">
								                <?php endif; ?>
								                <label for="quotes-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("quotes-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="quotes-add" name="quotes-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="quotes-add" name="quotes-add">
								                <?php endif; ?>
								                <label for="quotes-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("quotes-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="quotes-edit" name="quotes-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="quotes-edit" name="quotes-edit">
								                <?php endif; ?>
								                <label for="quotes-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("quotes-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="quotes-delete" name="quotes-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="quotes-delete" name="quotes-delete">
								                <?php endif; ?>
								                <label for="quotes-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>

						        <tr>
						            <td><?php echo e(trans('file.Transfer')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("transfers-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="transfers-index" name="transfers-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="transfers-index" name="transfers-index">
								                <?php endif; ?>
								                <label for="transfers-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("transfers-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="transfers-add" name="transfers-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="transfers-add" name="transfers-add">
								                <?php endif; ?>
								                <label for="transfers-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("transfers-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="transfers-edit" name="transfers-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="transfers-edit" name="transfers-edit">
								                <?php endif; ?>
								                <label for="transfers-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("transfers-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="transfers-delete" name="transfers-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="transfers-delete" name="transfers-delete">
								                <?php endif; ?>
								                <label for="transfers-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>

						        <tr>
						            <td><?php echo e(trans('file.Sale Return')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("returns-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="returns-index" name="returns-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="returns-index" name="returns-index">
								                <?php endif; ?>
								                <label for="returns-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("returns-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="returns-add" name="returns-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="returns-add" name="returns-add">
								                <?php endif; ?>
								                <label for="returns-add"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("returns-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="returns-edit" name="returns-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="returns-edit" name="returns-edit">
								                <?php endif; ?>
								                <label for="returns-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("returns-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="returns-delete" name="returns-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="returns-delete" name="returns-delete">
								                <?php endif; ?>
								                <label for="returns-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>

						        <tr>
						            <td><?php echo e(trans('file.Purchase Return')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("purchase-return-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="purchase-return-index" name="purchase-return-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="purchase-return-index" name="purchase-return-index">
								                <?php endif; ?>
								                <label for="purchase-return-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("purchase-return-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="purchase-return-add" name="purchase-return-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="purchase-return-add" name="purchase-return-add">
								                <?php endif; ?>
								                <label for="purchase-return-add"></label>
								            </div>
						                </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("purchase-return-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="purchase-return-edit" name="purchase-return-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="purchase-return-edit" name="purchase-return-edit">
								                <?php endif; ?>
								                <label for="purchase-return-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
						                	<div class="checkbox">
								                <?php if(in_array("purchase-return-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="purchase-return-delete" name="purchase-return-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="purchase-return-delete" name="purchase-return-delete">
								                <?php endif; ?>
								                <label for="purchase-return-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        <tr>
						            <td><?php echo e(trans('file.Employee')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("employees-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="employees-index" name="employees-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="employees-index" name="employees-index">
								                <?php endif; ?>
								                <label for="employees-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("employees-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="employees-add" name="employees-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="employees-add" name="employees-add">
								                <?php endif; ?>
								                <label for="employees-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("employees-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="employees-edit" name="employees-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="employees-edit" name="employees-edit">
								                <?php endif; ?>
								                <label for="employees-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("employees-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="employees-delete" name="employees-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="employees-delete" name="employees-delete">
								                <?php endif; ?>
								                <label for="employees-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        <tr>
						            <td><?php echo e(trans('file.User')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("users-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="users-index" name="users-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="users-index" name="users-index">
								                <?php endif; ?>
								                <label for="users-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("users-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="users-add" name="users-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="users-add" name="users-add">
								                <?php endif; ?>
								                <label for="users-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("users-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="users-edit" name="users-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="users-edit" name="users-edit">
								                <?php endif; ?>
								                <label for="users-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("users-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="users-delete" name="users-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="users-delete" name="users-delete">
								                <?php endif; ?>
								                <label for="users-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        <tr>
						            <td><?php echo e(trans('file.customer')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("customers-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="customers-index" name="customers-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="customers-index" name="customers-index">
								                <?php endif; ?>
								                <label for="customers-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("customers-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="customers-add" name="customers-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="customers-add" name="customers-add">
								                <?php endif; ?>
								                <label for="customers-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("customers-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="customers-edit" name="customers-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="customers-edit" name="customers-edit">
								                <?php endif; ?>
								                <label for="customers-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("customers-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="customers-delete" name="customers-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="customers-delete" name="customers-delete">
								                <?php endif; ?>
								                <label for="customers-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        <tr>
						            <td><?php echo e(trans('file.Biller')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("billers-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="billers-index" name="billers-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="billers-index" name="billers-index">
								                <?php endif; ?>
								                <label for="billers-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("billers-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="billers-add" name="billers-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="billers-add" name="billers-add">
								                <?php endif; ?>
								                <label for="billers-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("billers-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="billers-edit" name="billers-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="billers-edit" name="billers-edit">
								                <?php endif; ?>
								                <label for="billers-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("billers-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="billers-delete" name="billers-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="billers-delete" name="billers-delete">
								                <?php endif; ?>
								                <label for="billers-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        <tr>
						            <td><?php echo e(trans('file.Supplier')); ?></td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("suppliers-index", $all_permission)): ?>
								                <input type="checkbox" value="1" id="suppliers-index" name="suppliers-index" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="suppliers-index" name="suppliers-index">
								                <?php endif; ?>
								                <label for="suppliers-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("suppliers-add", $all_permission)): ?>
								                <input type="checkbox" value="1" id="suppliers-add" name="suppliers-add" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="suppliers-add" name="suppliers-add">
								                <?php endif; ?>
								                <label for="suppliers-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("suppliers-edit", $all_permission)): ?>
								                <input type="checkbox" value="1" id="suppliers-edit" name="suppliers-edit" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="suppliers-edit" name="suppliers-edit">
								                <?php endif; ?>
								                <label for="suppliers-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                <?php if(in_array("suppliers-delete", $all_permission)): ?>
								                <input type="checkbox" value="1" id="suppliers-delete" name="suppliers-delete" checked>
								                <?php else: ?>
								                <input type="checkbox" value="1" id="suppliers-delete" name="suppliers-delete">
								                <?php endif; ?>
								                <label for="suppliers-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        						        <tr>
						            <td><?php echo e(trans('file.Accounting')); ?></td>
						            <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("account-index", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="account-index" name="account-index" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="account-index" name="account-index">
							                    	<?php endif; ?>
								                    <label for="account-index" class="padding05"><?php echo e(trans('file.Account')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("money-transfer", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="money-transfer" name="money-transfer" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="money-transfer" name="money-transfer">
							                    	<?php endif; ?>
								                    <label for="money-transfer" class="padding05"><?php echo e(trans('file.Money Transfer')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("balance-sheet", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="balance-sheet" name="balance-sheet" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="balance-sheet" name="balance-sheet">
							                    	<?php endif; ?>
								                    <label for="balance-sheet" class="padding05"><?php echo e(trans('file.Balance Sheet')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
						                    	<div class="checkbox">
							                    	<?php if(in_array("account-statement", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="account-statement-permission" name="account-statement" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="account-statement-permission" name="account-statement">
							                    	<?php endif; ?>
								                    <label for="account-statement-permission" class="padding05"><?php echo e(trans('file.Account Statement')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr>
						        <tr>
						            <td>HRM</td>
						            <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("department", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="department" name="department" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="department" name="department">
							                    	<?php endif; ?>
								                    <label for="department" class="padding05"><?php echo e(trans('file.Department')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("attendance", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="attendance" name="attendance" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="attendance" name="attendance">
							                    	<?php endif; ?>
								                    <label for="attendance" class="padding05"><?php echo e(trans('file.Attendance')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("payroll", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="payroll" name="payroll" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="payroll" name="payroll">
							                    	<?php endif; ?>
								                    <label for="payroll" class="padding05"><?php echo e(trans('file.Payroll')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("holiday", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="holiday" name="holiday" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="holiday" name="holiday">
							                    	<?php endif; ?>
								                    <label for="holiday" class="padding05"><?php echo e(trans('file.Holiday Approve')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr>
						        <tr>
						            <td><?php echo e(trans('file.Reports')); ?></td>
						            <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("profit-loss", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="profit-loss" name="profit-loss" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="profit-loss" name="profit-loss">
							                    	<?php endif; ?>
								                    <label for="profit-loss" class="padding05"><?php echo e(trans('file.Summary Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("best-seller", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="best-seller" name="best-seller" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="best-seller" name="best-seller">
							                    	<?php endif; ?>
								                    <label for="best-seller" class="padding05"><?php echo e(trans('file.Best Seller')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("daily-sale", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="daily-sale" name="daily-sale" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="daily-sale" name="daily-sale">
							                    	<?php endif; ?>
								                    <label for="daily-sale" class="padding05"><?php echo e(trans('file.Daily Sale')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("monthly-sale", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="monthly-sale" name="monthly-sale" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="monthly-sale" name="monthly-sale">
							                    	<?php endif; ?>
								                    <label for="monthly-sale" class="padding05"><?php echo e(trans('file.Monthly Sale')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("daily-purchase", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="daily-purchase" name="daily-purchase" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="daily-purchase" name="daily-purchase">
							                    	<?php endif; ?>
								                    <label for="daily-purchase" class="padding05"><?php echo e(trans('file.Daily Purchase')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
						                    	<div class="checkbox">
							                    	<?php if(in_array("monthly-purchase", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="monthly-purchase" name="monthly-purchase" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="monthly-purchase" name="monthly-purchase">
							                    	<?php endif; ?>
								                    <label for="monthly-purchase" class="padding05"><?php echo e(trans('file.Monthly Purchase')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("product-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="product-report" name="product-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="product-report" name="product-report">
							                    	<?php endif; ?>
								                    <label for="product-report" class="padding05"><?php echo e(trans('file.Product Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("payment-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="payment-report" name="payment-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="payment-report" name="payment-report">
							                    	<?php endif; ?>
								                    <label for="payment-report" class="padding05"><?php echo e(trans('file.Payment Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("purchase-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="purchase-report" name="purchase-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="purchase-report" name="purchase-report">
							                    	<?php endif; ?>
								                    <label for="purchase-report" class="padding05"> <?php echo e(trans('file.Purchase Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("sale-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="sale-report" name="sale-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="sale-report" name="sale-report">
							                    	<?php endif; ?>
								                    <label for="sale-report" class="padding05"><?php echo e(trans('file.Sale Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
						                    	<div class="checkbox">
							                    	<?php if(in_array("warehouse-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="warehouse-report" name="warehouse-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="warehouse-report" name="warehouse-report">
							                    	<?php endif; ?>
								                    <label for="warehouse-report" class="padding05"><?php echo e(trans('file.Warehouse Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
						                    	<div class="checkbox">
							                    	<?php if(in_array("warehouse-stock-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="warehouse-stock-report" name="warehouse-stock-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="warehouse-stock-report" name="warehouse-stock-report">
							                    	<?php endif; ?>
								                    <label for="warehouse-stock-report" class="padding05"><?php echo e(trans('file.Warehouse Stock Chart')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
						                    	<div class="checkbox">
							                    	<?php if(in_array("product-qty-alert", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="product-qty-alert" name="product-qty-alert" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="product-qty-alert" name="product-qty-alert">
							                    	<?php endif; ?>
													<label for="product-qty-alert" class="padding05"><?php echo e(trans('file.Product Quantity Alert')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
								        </span>
								        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("user-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="user-report" name="user-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="user-report" name="user-report">
							                    	<?php endif; ?>
								                    <label for="user-report" class="padding05"><?php echo e(trans('file.User Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("customer-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="customer-report" name="customer-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="customer-report" name="customer-report">
							                    	<?php endif; ?>
								                    <label for="customer-report" class="padding05"><?php echo e(trans('file.Customer Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("supplier-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="supplier-report" name="supplier-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="supplier-report" name="supplier-report">
							                    	<?php endif; ?>
								                    <label for="Supplier-report" class="padding05"><?php echo e(trans('file.Supplier Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("due-report", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="due-report" name="due-report" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="due-report" name="due-report">
							                    	<?php endif; ?>
								                    <label for="due-report" class="padding05"><?php echo e(trans('file.Due Report')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr>
						        <tr>
						            <td><?php echo e(trans('file.settings')); ?></td>
						            <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("send_notification", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="send_notification" name="send_notification" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="send_notification" name="send_notification">
							                    	<?php endif; ?>
								                    <label for="send_notification" class="padding05"><?php echo e(trans('file.Send Notification')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("warehouse", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="warehouse" name="warehouse" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="warehouse" name="warehouse">
							                    	<?php endif; ?>
								                    <label for="warehouse" class="padding05"><?php echo e(trans('file.Warehouse')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("customer_group", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="customer_group" name="customer_group" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="customer_group" name="customer_group">
							                    	<?php endif; ?>
								                    <label for="customer_group" class="padding05"><?php echo e(trans('file.Customer Group')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
								            <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("brand", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="brand" name="brand" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="brand" name="brand">
							                    	<?php endif; ?>
								                    <label for="brand" class="padding05"><?php echo e(trans('file.Brand')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
								            <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("unit", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="unit" name="unit" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="unit" name="unit">
							                    	<?php endif; ?>
								                    <label for="unit" class="padding05"><?php echo e(trans('file.Unit')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
								            <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("currency", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="currency" name="currency" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="currency" name="currency">
							                    	<?php endif; ?>
								                    <label for="currency" class="padding05"><?php echo e(trans('file.Currency')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
								            <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("tax", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="tax" name="tax" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="tax" name="tax">
							                    	<?php endif; ?>
								                    <label for="tax" class="padding05"><?php echo e(trans('file.Tax')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("backup_database", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="backup_database" name="backup_database" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="backup_database" name="backup_database">
							                    	<?php endif; ?>
								                    <label for="backup_database" class="padding05"><?php echo e(trans('file.Backup Database')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("general_setting", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="general_setting" name="general_setting" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="general_setting" name="general_setting">
							                    	<?php endif; ?>
								                    <label for="general_setting" class="padding05"><?php echo e(trans('file.General Setting')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("mail_setting", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="mail_setting" name="mail_setting" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="mail_setting" name="mail_setting">
							                    	<?php endif; ?>
								                    <label for="mail_setting" class="padding05"><?php echo e(trans('file.Mail Setting')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("sms_setting", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="sms_setting" name="sms_setting" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="sms_setting" name="sms_setting">
							                    	<?php endif; ?>
								                    <label for="sms_setting" class="padding05"><?php echo e(trans('file.SMS Setting')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("create_sms", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="create_sms" name="create_sms" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="create_sms" name="create_sms">
							                    	<?php endif; ?>
								                    <label for="create_sms" class="padding05"><?php echo e(trans('file.Create SMS')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("pos_setting", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="pos_setting" name="pos_setting" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="pos_setting" name="pos_setting">
							                    	<?php endif; ?>
								                    <label for="pos_setting" class="padding05"><?php echo e(trans('file.POS Setting')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("hrm_setting", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="hrm_setting" name="hrm_setting" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="hrm_setting" name="hrm_setting">
							                    	<?php endif; ?>
								                    <label for="hrm_setting" class="padding05"><?php echo e(trans('file.HRM Setting')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr>
						        <tr>
						            <td><?php echo e(trans('file.Miscellaneous')); ?></td>
						            <td class="report-permissions" colspan="5">
						            	<span>
								            <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("category", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="category" name="category" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="category" name="category">
							                    	<?php endif; ?>
								                    <label for="category" class="padding05"><?php echo e(trans('file.category')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						            	</span>
						            	<span>
						            		<div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("delivery", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="delivery" name="delivery" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="delivery" name="delivery">
							                    	<?php endif; ?>
								                    <label for="delivery" class="padding05"><?php echo e(trans('file.Delivery')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						            	</span>
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("stock_count", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="stock_count" name="stock_count" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="stock_count" name="stock_count">
							                    	<?php endif; ?>
								                    <label for="stock_count" class="padding05"><?php echo e(trans('file.Stock Count')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("adjustment", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="adjustment" name="adjustment" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="adjustment" name="adjustment">
							                    	<?php endif; ?>
								                    <label for="adjustment" class="padding05"><?php echo e(trans('file.Adjustment')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("gift_card", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="gift_card" name="gift_card" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="gift_card" name="gift_card">
							                    	<?php endif; ?>
								                    <label for="gift_card" class="padding05"><?php echo e(trans('file.Gift Card')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("coupon", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="coupon" name="coupon" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="coupon" name="coupon">
							                    	<?php endif; ?>
								                    <label for="coupon" class="padding05"><?php echo e(trans('file.Coupon')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("print_barcode", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="print_barcode" name="print_barcode" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="print_barcode" name="print_barcode">
							                    	<?php endif; ?>
								                    <label for="print_barcode" class="padding05"><?php echo e(trans('file.print_barcode')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("empty_database", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="empty_database" name="empty_database" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="empty_database" name="empty_database">
							                    	<?php endif; ?>
								                    <label for="empty_database" class="padding05"><?php echo e(trans('file.Empty Database')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("today_sale", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="today_sale" name="today_sale" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="today_sale" name="today_sale">
							                    	<?php endif; ?>
								                    <label for="today_sale" class="padding05"><?php echo e(trans('file.Today Sale')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	<?php if(in_array("today_profit", $all_permission)): ?>
							                    	<input type="checkbox" value="1" id="today_profit" name="today_profit" checked>
							                    	<?php else: ?>
							                    	<input type="checkbox" value="1" id="today_profit" name="today_profit">
							                    	<?php endif; ?>
								                    <label for="today_profit" class="padding05"><?php echo e(trans('file.Today Profit')); ?> &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr>
						        </tbody>
						    </table>
						</div>
						<div class="form-group">
	                        <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
	                    </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

	$("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #role-menu").addClass("active");

	$("#select_all").on( "change", function() {
	    if ($(this).is(':checked')) {
	        $("tbody input[type='checkbox']").prop('checked', true);
	    } 
	    else {
	        $("tbody input[type='checkbox']").prop('checked', false);
	    }
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/role/permission.blade.php ENDPATH**/ ?>