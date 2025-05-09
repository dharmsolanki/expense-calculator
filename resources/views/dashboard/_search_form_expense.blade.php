<form method="GET" action="{{ route('viewExpense') }}" class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-control">
                <option value="">All</option>
                <option value="Food" {{ request('category') == 'Food' ? 'selected' : '' }}>Food</option>
                <option value="Transport" {{ request('category') == 'Transport' ? 'selected' : '' }}>Transport</option>
                <option value="Shopping" {{ request('category') == 'Shopping' ? 'selected' : '' }}>Shopping</option>
                <option value="Other" {{ request('category') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="">All</option>
                <option value="Cash" {{ request('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="Credit Card" {{ request('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                <option value="Debit Card" {{ request('payment_method') == 'Debit Card' ? 'selected' : '' }}>Debit Card</option>
                <option value="UPI" {{ request('payment_method') == 'UPI' ? 'selected' : '' }}>UPI</option>
            </select>
        </div>

        <div class="col-md-2">
            <label for="from_date" class="form-label">From Date</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>

        <div class="col-md-2">
            <label for="to_date" class="form-label">To Date</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn text-white w-100" style="background-color: #4b237b;">Search</button>
            <a href="{{ route('viewExpense') }}" class="btn btn-secondary w-100" style="background-color: #4b237b;">Reset</a>
        </div>

    </div>
</form>
