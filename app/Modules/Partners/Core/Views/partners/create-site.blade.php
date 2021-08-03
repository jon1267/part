<div class="card text-center ">
    <div class="card-header ">
        <p class="text-bold m-0">Ваши индивидуальные сайты:</p>
    </div>
    <div class="card-body">
        <p>Создайте название Вашего личного сайта</p>
        <div style="display: flex; flex-direction: column; align-items: center;">
        <form action="{{ route('cabinet.create.site') }}" method="POST"  >
            @csrf

            <div class="input-group input-group-sm" >
                <input class="form-control" style="text-align: right;" type="text"
                       id="domain" name="domain" value="{{ old('domain') }}">
                <span class="h6 m-2">.pdparis.com</span>
                <button type="submit" class="btn btn-success btn-sm" > Создать </button>
                <!-- <a href="" class="btn btn-success btn-sm"> Создать</a> -->
            </div>
        </form>
        </div>

        <div>
            @error('domain')
            <span class="invalid-feedback" style="display: inline-block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>






