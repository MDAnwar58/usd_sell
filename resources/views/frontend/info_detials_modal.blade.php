<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>User Name : {{ $user->name }}</li>
                    <li>User Unique Id : {{ $user->unique_id }}</li>
                    <li>User Total Balance : {{ $user->wallet->wallet }}</li>
                </ul>
                <form action="{{ route('money.request') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="saler_id" value="{{ $user->wallet->user_id }}">
                    <div class="mt-3" id="input-field-dev">
                        <label for="request-money" class=" ">Request Money</label>
                        <input type="text" name="amount" class="form-control" id="request-money"
                            placeholder="Enter your amount">
                    </div>
                    <div class="text-end pb-3 pt-1" id="btn-dev">
                        <button type="button" class="btn btn-primary" onclick="onRequest()" id="request-btn">Send
                            Request</button>
                        @if (Auth::user()->role === 'admin')
                            <button type="button" id="request-release-btn" class="btn btn-primary d-none"
                                onclick="onRequestRelease()">Please
                                Release</button>
                        @endif
                        <button type="submit" class="btn btn-primary d-none" id="request-confirm-release-btn"
                            onclick="onRemoveData()">Confirm
                            Release</button>
                    </div>
                </form>
                @if ($PostMassage)
                    @if ($PostMassage['from_id'] == Auth::user()->id)
                        <div class="alert alert-warning" role="alert">
                            Request For
                            <strong>{{ optional(App\Models\Post::find($PostMassage['post_id']))->for }}</strong>
                            Request Amount =
                            {{ $PostAmount['amount'] ?? optional(App\Models\Post::find($PostMassage['post_id']))->exchange_amount }}
                            {{-- Form to update amount --}}
                            <form action="{{ route('post_massage.update_amount') }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $PostMassage['post_id'] }}">
                                <input type="hidden" name="to_id" value="{{ $PostMassage['to_id'] }}">
                                <div class="form-group mt-2">
                                    <label for="update_amount">Update Amount</label>
                                    <input type="number" class="form-control" name="amount" id="update_amount"
                                        required>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('post_massage.remove', $PostMassage['post_id']) }}"
                                        class="btn btn-danger mt-2">Cancle</a>
                                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                </div>
                            </form>
                        </div>
                    @else
                        @if (optional(App\Models\Post::find($PostMassage['post_id'])))
                            <div class="alert alert-success" role="alert">
                                This User Request For Purchase
                                <strong>{{ optional(App\Models\Post::find($PostMassage['post_id']))->for }}</strong>
                                Request amount
                                {{ $PostAmount['amount'] ?? optional(App\Models\Post::find($PostMassage['post_id']))->exchange_amount }}
                                <a href="{{ route('post_massage.release', $PostMassage['post_id']) }}"
                                    class="alert-link mx-2">Release Now</a>
                                For Sell <a href="{{ route('post_massage.remove', $PostMassage['post_id']) }}"
                                    class="alert-link mx-2">Remove</a> for Remove
                            </div>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    let requestBtn = document.getElementById('request-btn');
    let inputFieldDev = document.getElementById('input-field-dev');
    let requestReleaseBtn = document.getElementById('request-release-btn');
    let requestConfirmReleaseBtn = document.getElementById('request-confirm-release-btn');
    let btnDev = document.getElementById('btn-dev');
    let userId = @json(Auth::user()->id);

    let mainRequestMoney = localStorage.getItem('requestMoney');
    if (mainRequestMoney) {
        mainRequestMoney = JSON.parse(mainRequestMoney);
        if (mainRequestMoney.status === "processing") {
            requestBtn.innerText = "Confirm Request";
        } else if (mainRequestMoney.status === "confirmed") {
            let requestMoney = document.getElementById('request-money');
            requestMoney.classList.add("d-none");
            requestBtn.classList.add("d-none");
            inputFieldDev.classList.add("text-center");
            btnDev.classList.remove("text-end");
            btnDev.classList.add("text-center");
            requestReleaseBtn.classList.remove("d-none");
        } else if (mainRequestMoney.status === "released") {
            let requestMoney = document.getElementById('request-money');
            requestMoney.classList.add("d-none");
            requestBtn.classList.add("d-none");
            inputFieldDev.classList.add("text-center");
            btnDev.classList.remove("text-end");
            btnDev.classList.add("text-center");
            requestReleaseBtn.classList.add("d-none");
            requestConfirmReleaseBtn.classList.remove("d-none");
        }
    }


    function onRequest() {
        let requestMoney = document.getElementById('request-money');
        if (requestMoney.value !== "") {
            let data = {
                user_id: userId,
                amount: requestMoney.value,
                status: "processing",
            }
            localStorage.setItem('requestMoney', JSON.stringify(data));

            let RequestMoney = localStorage.getItem('requestMoney');
            RequestMoney = JSON.parse(RequestMoney);
            if (RequestMoney.status === "processing" && requestBtn.innerText === "Confirm Request") {
                if (requestBtn.innerText === "Confirm Request") {
                    let dataObject = {
                        user_id: RequestMoney.user_id,
                        amount: RequestMoney.amount,
                        status: "confirmed",
                    }
                    localStorage.setItem('requestMoney', JSON.stringify(dataObject));

                    let ConfirmRequestMoney = localStorage.getItem('requestMoney');
                    ConfirmRequestMoney = JSON.parse(ConfirmRequestMoney);
                    if (ConfirmRequestMoney.status === "confirmed") {
                        requestMoney.classList.add("d-none");
                        requestBtn.classList.add("d-none");
                        inputFieldDev.classList.add("text-center");
                        btnDev.classList.remove("text-end");
                        btnDev.classList.add("text-center");
                        requestReleaseBtn.classList.remove("d-none");
                    }
                }
            } else if (RequestMoney.status === "processing") {
                requestBtn.innerText = "Confirm Request";
            }
        }
    }

    function onRequestRelease() {
        let RequestMoney = localStorage.getItem('requestMoney');
        RequestMoney = JSON.parse(RequestMoney);
        if (RequestMoney.status === "confirmed") {
            let data = {
                user_id: RequestMoney.user_id,
                amount: RequestMoney.amount,
                status: "released",
            }
            localStorage.setItem('requestMoney', JSON.stringify(data));

            let ReleaseRequestMoney = localStorage.getItem('requestMoney');
            ReleaseRequestMoney = JSON.parse(ReleaseRequestMoney);
            if (ReleaseRequestMoney.status === "released") {
                btnDev.classList.remove("text-end");
                btnDev.classList.add("text-center");
                requestReleaseBtn.classList.add("d-none");
                requestConfirmReleaseBtn.classList.remove("d-none");
            }
        }
    }

    function onRemoveData() {
        localStorage.setItem('requestMoney', "");
    }
</script>
