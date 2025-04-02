@extends('layouts.app')

@section('title', 'Add Expense')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-white" style="background-color: #4b237b;">
                        <h4 class="mb-0">Add Expense</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('addExpense') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" class="form-control" id="category" required>
                                    <option value="Food">Food</option>
                                    <option value="Transport">Transport</option>
                                    <option value="Shopping">Shopping</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3" id="div_expense_name">
                                <label for="expense_name" class="form-label">Expense Name</label>
                                <input type="text" name="expense_name" class="form-control" id="expense_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-control" id="payment_method" required>
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Debit Card">Debit Card</option>
                                    <option value="UPI">UPI</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" id="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" name="amount" class="form-control" id="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn text-white w-100" style="background-color: #4b237b;">Add
                                Expense</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const div_expense_name = document.getElementById("div_expense_name");
        if (div_expense_name) {
            div_expense_name.style.display = 'none';
        }

        document.addEventListener('change', function() {
            const category = document.getElementById("category").value;
            switch (category) {
                case "Other":
                    div_expense_name.style.display = "block";
                    break;

                default:
                    div_expense_name.style.display = 'none';
                    break;
            }
        })
    </script>
@endsection
