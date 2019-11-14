<?php insert( 'layout.header' ) ?>


<div id="app">
    <div class="container mt-3">
        <div class="row">
            <div class="col col-12">
                <div class="card">
                    <div class="card-body">
                        <div class=""></div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="from">From</label>
                                <input type="date" class="form-control" name="from" id="from" placeholder="Email">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="to">To</label>
                                <input type="date" class="form-control" name="to" id="to" placeholder="Password">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="id">By ID</label>
                                <input type="number" name="id" class="form-control" id="id" placeholder="ID">
                            </div>
                            <div class="form-group col-md-1">
                                <button type="button" id="reset"
                                        style="margin-top: 40%"
                                        class="btn btn-warning">Reset
                                </button>
                            </div>
                            <div class="form-group col-md-1 offset-3">
                                <p id="inputPassword4"
                                   style="margin-top: 40%"
                                   class="btn btn-primary"
                                   data-toggle="modal"
                                   data-target=".bd-example-modal-lg">Add</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
				<?php $data = count( $orders ) > 0 ?? false; ?>
                <table class="table  table-dark table-responsive <?= $data ? '' : 'invisible' ?>">
                    <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">amount</th>
                        <th scope="col">buyer</th>
                        <th scope="col">receipt_id</th>
                        <th scope="col">items</th>
                        <th scope="col">buyer_email</th>
                        <th scope="col">buyer_ip</th>
                        <th scope="col">note</th>
                        <th scope="col">city</th>
                        <th scope="col">phone</th>
                        <th scope="col">hash_key</th>
                        <th scope="col">entry_at</th>
                        <th scope="col">entry_by</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
					<?php foreach ( $orders as $order ): ?>
                        <tr>
                            <th scope="row">#<?= $order->id ?></th>
                            <th><?= $order->amount ?></th>
                            <th><?= $order->buyer ?></th>
                            <th><?= $order->receipt_id ?></th>
                            <th><?= $order->items ?></th>
                            <th><?= $order->buyer_email ?></th>
                            <th><?= $order->buyer_ip ?></th>
                            <th><?= $order->note ?></th>
                            <th><?= $order->city ?></th>
                            <th><?= $order->phone ?></th>
                            <th class="hash_key"><?= $order->hash_key ?></th>
                            <th><?= $order->entry_at ?></th>
                            <th><?= $order->entry_by ?></th>
                        </tr>
					<?php endforeach; ?>
                    </tbody>
                </table>
                <h1 class="text-center text-black-50 mt-4 no-found <?= $data ? 'invisible' : '' ?>">No records
                    found.</h1>

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form id="order_add_form" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" maxlength="10" class="form-control" id="amount"
                                   placeholder="amount">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="buyer">Buyer</label>
                            <input type="text" name="buyer" maxlength="255" class="form-control" id="buyer"
                                   placeholder="Buyer">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receipt_id">receipt_id</label>
                        <input type="text" name="receipt_id" maxlength="20" class="form-control" id="receipt_id"
                               placeholder="receipt_id">
                    </div>
                    <div class="form-group">
                        <label for="items">items</label>
                        <input type="text" name="items" class="form-control" id="items"
                               placeholder="items">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="buyer_email">buyer_email</label>
                            <input type="email" class="form-control" name="buyer_email" id="buyer_email">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="note">note</label>
                            <input type="text" name="note" class="form-control" id="note">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="city">city</label>
                            <input type="text" class="form-control" name="city" id="city">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">phone</label>
                            <input type="number" name="phone" class="form-control" id="phone">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="entry_by">entry_by</label>
                            <input type="number" name="entry_by" class="form-control" id="entry_by">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="submit" form="order_add_form" class="btn btn-outline-success">Save</button>
            </div>
        </div>
    </div>
</div>

<?php insert( 'layout.footer' ) ?>
