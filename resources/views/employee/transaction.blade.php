<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background: #f4f6fb;
        font-family: 'Segoe UI', sans-serif;
    }

    /* ================= NAVBAR ================= */
    .navbar {
        background: linear-gradient(135deg, #1f2937, #111827);
    }

    /* ================= CARD GLOBAL ================= */
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }

    .card-header {
        background: #f9fafb;
        border-bottom: 1px solid #eee;
        font-weight: 600;
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }

    /* ================= PRODUCT CARD ================= */
    #product-step .card {
        transition: 0.2s;
    }

    #product-step .card:hover {
        transform: translateY(-2px);
    }

    .card-img-top {
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    /* ================= BUTTON ================= */
    .btn {
        border-radius: 10px !important;
        font-weight: 500;
    }

    .btn-success {
        box-shadow: 0 10px 20px rgba(34,197,94,0.2);
    }

    .btn-primary {
        box-shadow: 0 10px 20px rgba(13,110,253,0.2);
    }

    /* ================= INPUT ================= */
    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 10px 12px;
    }

    /* ================= STEP ANIMATION ================= */
    #product-step,
    #customer-step,
    #payment-step {
        animation: fadeIn 0.25s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ================= QUANTITY BUTTON ================= */
    .input-group .btn {
        border-radius: 10px;
    }

    .quantity-input {
        text-align: center;
        font-weight: 600;
    }

    /* ================= PAYMENT SUMMARY ================= */
    #payment-step .card-body h5 {
        font-weight: 700;
        color: #111827;
    }

    #payment-step .d-flex {
        padding: 2px 0;
    }

    #ui_total_price,
    #ui_final_price {
        color: #111827;
    }

    #ui_discount {
        color: #dc2626;
    }

    #ui_change {
        color: #16a34a;
    }

    /* ================= RECEIPT ================= */
    #receipt-block {
        background: #f9fafb;
        padding: 15px;
        border-radius: 12px;
        border: 1px dashed #ddd;
    }

    #receipt-block h5 {
        font-weight: 700;
        margin-bottom: 10px;
    }

    /* ================= CARD PRODUCT IMAGE ================= */
    .card-body img {
        border-radius: 12px;
    }

    /* ================= STEP BUTTON AREA ================= */
    .d-flex.justify-content-between button {
        min-width: 120px;
    }

</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Employee Panel</a>
            <div class="navbar-nav ms-auto">
                <a href="{{ route('employee.dashboard') }}" class="nav-link">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>New Transaction</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('employee.transactions.store') }}">
            @csrf

            <div id="product-step" class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Products</span>
                    <button type="button" class="btn btn-success btn-sm" id="continue-button">Lanjut</button>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="card h-100">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <span class="text-muted">No image</span>
                                        </div>
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text mb-1">Price: {{ $product->harga_rupiah }}</p>
                                        <p class="card-text mb-1">Stock: {{ $product->stock }}</p>

                                        <div class="mt-auto">
                                            <label class="form-label">Quantity</label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-outline-secondary quantity-decrease" data-product-id="{{ $product->id }}">-</button>
                                                <input type="number" class="form-control quantity-input" id="product_qty_{{ $product->id }}" name="products[{{ $product->id }}]" value="{{ old('products.' . $product->id, 0) }}" min="0" max="{{ $product->stock }}" readonly>
                                                <button type="button" class="btn btn-outline-secondary quantity-increase" data-product-id="{{ $product->id }}">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div id="customer-step" class="card mb-4" style="display: none;">
                <div class="card-header">Customer</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="customer_type" class="form-label">Customer Type</label>
                        <select class="form-select" id="customer_type" name="customer_type">
                            <option value="member" {{ old('customer_type', 'member') === 'member' ? 'selected' : '' }}>Member</option>
                            <option value="non-member" {{ old('customer_type') === 'non-member' ? 'selected' : '' }}>Non-member</option>
                        </select>
                    </div>

                    <div id="member-fields" style="display: none;">
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="081234567890">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Boy">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" id="back-to-products">Kembali</button>
                        <button type="button" class="btn btn-success" id="to-payment-button">Next</button>
                    </div>
                </div>
            </div>

            <div id="payment-step" style="display: none;">
                <div class="card mb-4">
                    <div class="card-header">Pembayaran</div>

                    <div class="card-body">

                        <!-- ================= SUMMARY ================= -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="mb-3">Ringkasan Transaksi</h5>

                                <div class="d-flex justify-content-between">
                                    <span>Total Harga</span>
                                    <strong id="ui_total_price">Rp 0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Diskon (1%)</span>
                                    <strong id="ui_discount">Rp 0</strong>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between">
                                    <span>Total Bayar</span>
                                    <strong id="ui_final_price">Rp 0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Kembalian</span>
                                    <strong id="ui_change">Rp 0</strong>
                                </div>
                            </div>
                        </div>

                        <!-- ================= MEMBER ================= -->
                        <div id="member-payment" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Amount Paid</label>
                                <input type="number" class="form-control" id="total_pay_member" min="0" step="1">
                            </div>

                            <div class="mb-3" id="points-section" style="display: none;">
                                <p>Available Points: <span id="available_points">0</span></p>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="use_points" name="use_points" value="1">
                                    <label class="form-check-label">Use points (1% discount)</label>
                                </div>

                                <div class="mt-2" id="points-input-section" style="display: none;">
                                    <label class="form-label">Points Used</label>
                                    <input type="number" class="form-control" id="points_used_display" disabled>
                                    <input type="hidden" id="points_used" name="points_used">
                                </div>
                            </div>
                        </div>

                        <!-- ================= NON MEMBER ================= -->
                        <div id="non-member-payment" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name_non_member" placeholder="John Doe">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Amount Paid</label>
                                <input type="number" class="form-control" id="total_pay_non_member" min="0" step="1">
                            </div>
                        </div>

                        <!-- ================= RECEIPT ================= -->
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-success" id="show-receipt-button">
                                Show Receipt
                            </button>
                        </div>

                        <div id="receipt-block" style="display: none;">
                            <h5>Receipt</h5>

                            <div><strong>Customer:</strong> <span id="receipt_customer_name">-</span></div>
                            <div><strong>Total Items:</strong> <span id="receipt_total_items">0</span></div>
                            <div><strong>Total Price:</strong> <span id="receipt_total_price">0</span></div>
                            <div><strong>Paid:</strong> <span id="receipt_amount_paid">0</span></div>
                            <div><strong>Change:</strong> <span id="receipt_change">0</span></div>
                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" id="back-to-customer">Back</button>
                    <button type="submit" class="btn btn-primary" id="submit-button">Pay & Finish</button>
                </div>

                <input type="hidden" name="total_pay" id="total_pay_hidden">
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {

        // ================= ELEMENT =================
        const customerTypeSelect = document.getElementById('customer_type');
        const memberFields = document.getElementById('member-fields');
        const nonMemberPayment = document.getElementById('non-member-payment');
        const memberPayment = document.getElementById('member-payment');

        const pointsSection = document.getElementById('points-section');
        const pointsInputSection = document.getElementById('points-input-section');
        const usePointsCheckbox = document.getElementById('use_points');
        const pointsUsedHidden = document.getElementById('points_used');
        const availablePointsSpan = document.getElementById('available_points');

        const productStep = document.getElementById('product-step');
        const customerStep = document.getElementById('customer-step');
        const paymentStep = document.getElementById('payment-step');

        const continueButton = document.getElementById('continue-button');
        const backToProducts = document.getElementById('back-to-products');
        const toPaymentButton = document.getElementById('to-payment-button');
        const backToCustomer = document.getElementById('back-to-customer');

        const submitButton = document.getElementById('submit-button');
        const showReceiptButton = document.getElementById('show-receipt-button');
        const receiptBlock = document.getElementById('receipt-block');

        const totalPayMember = document.getElementById('total_pay_member');
        const totalPayNonMember = document.getElementById('total_pay_non_member');
        const totalPayHidden = document.getElementById('total_pay_hidden');

        const quantityInputs = document.querySelectorAll('.quantity-input');
        const increaseBtns = document.querySelectorAll('.quantity-increase');
        const decreaseBtns = document.querySelectorAll('.quantity-decrease');

        increaseBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.productId;
                const input = document.getElementById('product_qty_' + id);

                const max = parseInt(input.max);
                let val = parseInt(input.value || 0);

                if (val < max) {
                    input.value = val + 1;
                    updatePayment();
                }
            });
        });

        decreaseBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.productId;
                const input = document.getElementById('product_qty_' + id);

                let val = parseInt(input.value || 0);

                if (val > 0) {
                    input.value = val - 1;
                    updatePayment();
                }
            });
        });

        const receiptTotalItems = document.getElementById('receipt_total_items');
        const receiptTotalPrice = document.getElementById('receipt_total_price');
        const receiptAmountPaid = document.getElementById('receipt_amount_paid');
        const receiptChange = document.getElementById('receipt_change');
        const receiptCustomerName = document.getElementById('receipt_customer_name');

        // ================= SAFE INIT (FIX BUG UTAMA) =================
        const initialCustomerType = @json(old('customer_type', 'member'));
        const initialStep = @json($errors->any() ? (old('total_pay', 0) > 0 ? 3 : 2) : 1);

        let currentCustomerType = initialCustomerType;
        let customerPoints = 0;

        // ================= STEP =================
        function showStep(step) {
            productStep.style.display = step === 1 ? 'block' : 'none';
            customerStep.style.display = step === 2 ? 'block' : 'none';
            paymentStep.style.display = step === 3 ? 'block' : 'none';
        }

        // ================= CHECK PRODUCT =================
        function hasSelectedProducts() {
            return [...quantityInputs].some(i => parseInt(i.value || 0) > 0);
        }

        // ================= FORMAT =================
        function formatRupiah(val) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(val || 0);
        }

        // ================= CALC =================
        function calculateTotal() {
            let total = 0;
            let totalItems = 0;

            quantityInputs.forEach(input => {
                let qty = parseInt(input.value || 0);

                if (qty > 0) {
                    const card = input.closest('.card');

                    // AMBIL PRICE YANG BENAR
                    const priceText = card.querySelectorAll('.card-text')[0].textContent;
                    const price = parseInt(priceText.replace(/[^0-9]/g, '')) || 0;

                    total += price * qty;
                    totalItems += qty;
                }
            });

            return { total, totalItems };
        }

        // ================= UI CUSTOMER =================
        function updateCustomerUI() {
            const isMember = customerTypeSelect.value === 'member';
            currentCustomerType = customerTypeSelect.value;

            memberFields.style.display = isMember ? 'block' : 'none';
        }

        // ================= PAYMENT UI =================
        function updatePaymentUI() {
            const isMember = currentCustomerType === 'member';

            memberPayment.style.display = isMember ? 'block' : 'none';
            nonMemberPayment.style.display = isMember ? 'none' : 'block';

            submitButton.disabled = true;
            receiptBlock.style.display = 'none';
            showReceiptButton.style.display = 'inline-block';

            // 🔥 TAMBAHAN PENTING INI
            if (isMember) {
                fetchCustomerPoints();
            } else {
                pointsSection.style.display = 'none';
                pointsInputSection.style.display = 'none';
            }
        }

        function fetchCustomerPoints() {
            const phone = document.getElementById('phone_number')?.value;

            if (!phone) {
                pointsSection.style.display = 'none';
                return;
            }

            fetch(`/employee/check-customer-points?phone=${phone}`)
                .then(res => res.json())
                .then(data => {

                    customerPoints = data.points || 0;

                    if (customerPoints > 0) {
                        pointsSection.style.display = 'block';
                        availablePointsSpan.textContent = customerPoints;

                        usePointsCheckbox.disabled = false;
                    } else {
                        pointsSection.style.display = 'none';
                        usePointsCheckbox.checked = false;
                    }
                })
                .catch(() => {
                    pointsSection.style.display = 'none';
                });
        }

        // ================= PAYMENT CALC =================
        function updatePayment() {
            const { total, totalItems } = calculateTotal();

            const paid = currentCustomerType === 'member'
                ? parseInt(totalPayMember.value || 0)
                : parseInt(totalPayNonMember.value || 0);

            let discount = 0;

            // ================= DISKON =================
            if (usePointsCheckbox.checked) {
                // 🔥 DISKON 1%
                discount = total * 0.01;

                // safety: jangan sampai diskon lebih besar dari total
                discount = Math.min(discount, total);
            }

            const final = total - discount;
            const change = Math.max(paid - final, 0);

            // ================= UI UPDATE =================
            document.getElementById('ui_total_price').textContent = formatRupiah(total);
            document.getElementById('ui_discount').textContent = formatRupiah(discount);
            document.getElementById('ui_final_price').textContent = formatRupiah(final);
            document.getElementById('ui_change').textContent = formatRupiah(change);

            // hidden input
            totalPayHidden.value = paid;
        }

        // ================= RECEIPT =================
        function renderReceipt() {
        const { total, totalItems } = calculateTotal();

            const paid = currentCustomerType === 'member'
                ? parseInt(totalPayMember.value || 0)
                : parseInt(totalPayNonMember.value || 0);

            receiptTotalItems.textContent = totalItems;
            receiptTotalPrice.textContent = formatRupiah(total);
            receiptAmountPaid.textContent = formatRupiah(paid);
            receiptChange.textContent = formatRupiah(paid - total);

            const name = document.getElementById('name')?.value || 'Non-member';
            receiptCustomerName.textContent = name;
        }

        // ================= EVENTS =================

        continueButton.addEventListener('click', () => {
            if (!hasSelectedProducts()) return alert('Pilih produk dulu');
            showStep(2);
        });

        backToProducts.addEventListener('click', () => showStep(1));
        backToCustomer.addEventListener('click', () => showStep(2));

        toPaymentButton.addEventListener('click', () => {
            if (!hasSelectedProducts()) return alert('Pilih produk dulu');

            currentCustomerType = customerTypeSelect.value;

            updatePaymentUI();
            fetchCustomerPoints(); // 🔥 FORCE LOAD POINTS
            showStep(3);
            updatePayment();
        });

        showReceiptButton.addEventListener('click', () => {
            renderReceipt();
            receiptBlock.style.display = 'block';
            showReceiptButton.style.display = 'none';
            submitButton.disabled = false;
        });

        customerTypeSelect.addEventListener('change', updateCustomerUI);

        totalPayMember?.addEventListener('input', updatePayment);
        totalPayNonMember?.addEventListener('input', updatePayment);

        usePointsCheckbox.addEventListener('change', () => {
            if (usePointsCheckbox.checked) {
                pointsInputSection.style.display = 'block';
                pointsUsedHidden.value = customerPoints;
                document.getElementById('points_used_display').value = customerPoints;
            } else {
                pointsInputSection.style.display = 'none';
                pointsUsedHidden.value = 0;
            }

            updatePayment();
        });

        // ================= INIT =================
        window.addEventListener('load', () => {
            customerTypeSelect.value = initialCustomerType;
            updateCustomerUI();
            showStep(initialStep);
        });

    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
