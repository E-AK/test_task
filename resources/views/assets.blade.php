<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Активы</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    </head>

    <body onload="load_default()">
        <div class="container">
            <h1>Активы</h1>

            <form action="/create" method="POST" id="add_form">
                @csrf
                @method('post')

                <div class="mb-3">
                    <label for="name" class="form-label" id="create">Название</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Тип актива</label>
                    <select name="type" id="select_type" onchange="update_form()">
                        <option value="bank">Деньги в банке</option>
                        <option value="cash">Деньги в кассе</option>
                        <option value="ticket">Талоны</option>
                        <option value="non_monetary">Неденежные активы</option>
                    </select>
                </div>

                <div id="generated"></div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success mb-3">Добавить</button>
                </div>
            </form>

            <hr>

            <div class="list-group">
                @for($i = 0; $i < count($assets); $i++)
                    <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="collapse" data-bs-target={{ "#asset" . $i }} aria-expanded="true" aria-controls="asset0">
                        {{  $assets[$i]->name;  }}
                    </button>

                    <div class="collapse" id={{ "asset" . $i }}>
                        <div class="card card-body">
                            <form action={{ "/update/" . $i }} method="post" id="add_form">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="name" class="form-label" id="create">Название</label>
                                    <input type="text" class="form-control" name="name" id="name" value={{ $assets[$i]->name; }} required>
                                </div>

                                @if($assets[$i]->type == "bank")
                                    <div class="mb-3">
                                        <label for="bank_name" class="form-label" id="create">Название банка</label>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name" value={{ $assets[$i]->bank_name; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bank_account_number" class="form-label" id="create">Номер счета</label>
                                        <input type="text" class="form-control" name="bank_account_number" id="bank_account_number" value={{ $assets[$i]->bank_account_number; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="currency" class="form-label" id="create">Валюта</label>
                                        <input type="text" class="form-control" name="currency" id="currency" value={{ $assets[$i]->money->currency; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="units" class="form-label" id="create">Целая часть суммы</label>
                                        <input type="number" class="form-control" name="units" id="units" value={{ $assets[$i]->money->units; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nano" class="form-label" id="create">Дробная часть суммы</label>
                                        <input type="number" class="form-control" name="nano" id="nano" value={{ $assets[$i]->money->nano; }} required>
                                    </div>
                                    <input type="hidden" name="type" value="bank"></p>
                                @elseif($assets[$i]->type == "cash")
                                    <div class="mb-3">
                                        <label for="currency" class="form-label" id="create">Валюта</label>
                                        <input type="text" class="form-control" name="currency" id="currency" value={{ $assets[$i]->money->currency; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="units" class="form-label" id="create">Целая часть суммы</label>
                                        <input type="number" class="form-control" name="units" id="units" value={{ $assets[$i]->money->units; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nano" class="form-label" id="create">Дробная часть суммы</label>
                                        <input type="number" class="form-control" name="nano" id="nano" value={{ $assets[$i]->money->nano; }} required>
                                    </div>
                                    <input type="hidden" name="type" value="cash"></p>
                                @elseif($assets[$i]->type == "ticket")
                                    <div class="mb-3">
                                        <label for="currency" class="form-label" id="create">Валюта</label>
                                        <input type="text" class="form-control" name="currency" id="currency" value={{ $assets[$i]->money->currency; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="units" class="form-label" id="create">Целая часть суммы</label>
                                        <input type="number" class="form-control" name="units" id="units" value={{ $assets[$i]->money->units; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nano" class="form-label" id="create">Дробная часть суммы</label>
                                        <input type="number" class="form-control" name="nano" id="nano" value={{ $assets[$i]->money->nano; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="unit" class="form-label" id="create">Количество</label>
                                        <input type="number" class="form-control" name="unit" id="unit" value={{ $assets[$i]->money->nano; }} required>
                                    </div>
                                    <input type="hidden" name="type" value="ticket"></p>
                                @elseif($assets[$i]->type == "non_monetary")
                                    <div class="mb-3">
                                        <label for="inventory_number" class="form-label" id="create">Инвентарный номер  </label>
                                        <input type="text" class="form-control" name="inventory_number" id="inventory_number" value={{ $assets[$i]->inventory_number; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_of_manufacture" class="form-label" id="create">Дата производства</label>
                                        <input type="text" class="form-control" name="date_of_manufacture" id="date_of_manufacture" value={{ $assets[$i]->date_of_manufacture; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="count" class="form-label" id="create">Количество</label>
                                        <input type="number" class="form-control" name="count" id="count" value={{ $assets[$i]->count; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="unit" class="form-label" id="create">Единица измерения</label>
                                        <input type="text" class="form-control" name="unit" id="unit" value={{ $assets[$i]->unit; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="currency" class="form-label" id="create">Валюта</label>
                                        <input type="text" class="form-control" name="currency" id="currency" value={{ $assets[$i]->currency; }} required>
                                    </div>
                                    <h3>Начальная стоимость:</h3>
                                    <div class="mb-3">
                                        <label for="units_initial_cost" class="form-label" id="create">Целая часть суммы</label>
                                        <input type="number" class="form-control" name="units_initial_cost" id="units_initial_cost" value={{ $assets[$i]->initial_cost->units; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nano_initial_cost" class="form-label" id="create">Дробная часть суммы</label>
                                        <input type="number" class="form-control" name="nano_initial_cost" id="nano_initial_cost" value={{ $assets[$i]->initial_cost->nano; }} required>
                                    </div>
                                    <h3>Остаточная стоимость:</h3>
                                    <div class="mb-3">
                                        <label for="units_residual_value" class="form-label" id="create">Целая часть суммы</label>
                                        <input type="number" class="form-control" name="units_residual_value" id="units_residual_value" value={{ $assets[$i]->residual_value->units; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nano_residual_value" class="form-label" id="create">Дробная часть суммы</label>
                                        <input type="number" class="form-control" name="nano_residual_value" id="nano_residual_value" value={{ $assets[$i]->residual_value->nano; }} required>
                                    </div>
                                    <h3>Оценочная стоимость:</h3>
                                    <div class="mb-3">
                                        <label for="units_assessed_value" class="form-label" id="create">Целая часть суммы</label>
                                        <input type="number" class="form-control" name="units_assessed_value" id="units_assessed_value" value={{ $assets[$i]->assessed_value->units; }} required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nano_assessed_value" class="form-label" id="create">Дробная часть суммы</label>
                                        <input type="number" class="form-control" name="nano_assessed_value" id="nano_assessed_value" value={{ $assets[$i]->assessed_value->nano; }} required>
                                    </div>
                                    <input type="hidden" name="type" value="non_monetary"></p>
                                @endif
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success mb-3">Обновить</button>
                                </div>
                            </form>

                            <div class="d-grid gap-2">
                                <form action={{ "/" . $i }} method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <br>
        <br>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        <script>
            function load_default() {
                let form = document.getElementById("generated");

                form.innerHTML = "\
                            <div class='mb-3'> \
                                <label for='bank_name' class='form-label'>Название банка</label> \
                                <input type='text' class='form-control' name='bank_name' id='bank_name' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='bank_account_number' class='form-label'>Номер счета</label> \
                                <input type='text' class='form-control' name='bank_account_number' id='bank_account_number' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='currency' class='form-label'>Валюта</label> \
                                <input type='text' class='form-control' name='currency' id='currency' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='units' class='form-label'>Целая часть суммы</label> \
                                <input type='number' class='form-control' name='units' id='units' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='nano' class='form-label'>Дробная часть суммы</label> \
                                <input type='number' class='form-control' name='nano' id='nano' required> \
                            </div> \
                        ";
            }

            function update_form() {
                let form = document.getElementById("generated");
                let select_type = document.getElementById("select_type").value;
                
                switch(select_type) {
                    case "cash":
                        form.innerHTML = "\
                            <div class='mb-3'> \
                                <label for='currency' class='form-label'>Валюта</label> \
                                <input type='text' class='form-control' name='currency' id='currency' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='units' class='form-label'>Целая часть суммы</label> \
                                <input type='number' class='form-control' name='units' id='units' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='nano' class='form-label'>Дробная часть суммы</label> \
                                <input type='number' class='form-control' name='nano' id='nano' required> \
                            </div> \
                        ";
                        break;
                    case "ticket":
                        form.innerHTML = "\
                            <div class='mb-3'> \
                                <label for='currency' class='form-label'>Валюта</label> \
                                <input type='text' class='form-control' name='currency' id='currency' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='units' class='form-label'>Целая часть суммы</label> \
                                <input type='number' class='form-control' name='units' id='units' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='nano' class='form-label'>Дробная часть суммы</label> \
                                <input type='number' class='form-control' name='nano' id='nano' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='unit' class='form-label'>Количество</label> \
                                <input type='number' class='form-control' name='unit' id='units' required> \
                            </div> \
                        ";
                        break;
                    case "non_monetary":
                        form.innerHTML = "\
                            <div class='mb-3'> \
                                <label for='inventory_number' class='form-label'>Инвентарный номер</label> \
                                <input type='number' class='form-control' name='inventory_number' id='inventory_number' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='date_of_manufacture' class='form-label'>Дата производства</label> \
                                <input type='text' class='form-control' name='date_of_manufacture' id='date_of_manufacture' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='count' class='form-label'>Количество</label> \
                                <input type='number' class='form-control' name='count' id='count' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='unit' class='form-label'>Единица измерения</label> \
                                <input type='text' class='form-control' name='unit' id='unit' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='currency' class='form-label'>Валюта</label> \
                                <input type='text' class='form-control' name='currency' id='currency' required> \
                            </div> \
                            <h3>Начальная стоимость</\h3>\
                            <div class='mb-3'> \
                                <label for='units_initial_cost' class='form-label'>Целая часть суммы</label> \
                                <input type='number' class='form-control' name='units_initial_cost' id='units_initial_cost' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='nano_initial_cost' class='form-label'>Дробная часть суммы</label> \
                                <input type='number' class='form-control' name='nano_initial_cost' id='nano_initial_cost' required> \
                            </div> \
                            <h3>Остаточная стоимость</\h3>\
                            <div class='mb-3'> \
                                <label for='units_residual_value' class='form-label'>Целая часть суммы</label> \
                                <input type='number' class='form-control' name='units_residual_value' id='units_residual_value' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='nano_residual_value' class='form-label'>Дробная часть суммы</label> \
                                <input type='number' class='form-control' name='nano_residual_value' id='nano_residual_value' required> \
                            </div> \
                            <h3>Оценочная стоимость</\h3>\
                            <div class='mb-3'> \
                                <label for='units_assessed_value' class='form-label'>Целая часть суммы</label> \
                                <input type='number' class='form-control' name='units_assessed_value' id='units_assessed_value' required> \
                            </div> \
                            <div class='mb-3'> \
                                <label for='nano_assessed_value' class='form-label'>Дробная часть суммы</label> \
                                <input type='number' class='form-control' name='nano_assessed_value' id='nano_assessed_value' required> \
                            </div> \
                        ";
                        break;
                    default:
                        form.innerHTML = "\
                                <div class='mb-3'> \
                                    <label for='bank_name' class='form-label'>Название банка</label> \
                                    <input type='text' class='form-control' name='bank_name' id='bank_name' required> \
                                </div> \
                                <div class='mb-3'> \
                                    <label for='bank_account_number' class='form-label'>Номер счета</label> \
                                    <input type='text' class='form-control' name='bank_account_number' id='bank_account_number' required> \
                                </div> \
                                <div class='mb-3'> \
                                    <label for='currency' class='form-label'>Валюта</label> \
                                    <input type='text' class='form-control' name='currency' id='currency' required> \
                                </div> \
                                <div class='mb-3'> \
                                    <label for='units' class='form-label'>Целая часть суммы</label> \
                                    <input type='number' class='form-control' name='units' id='units' required> \
                                </div> \
                                <div class='mb-3'> \
                                    <label for='nano' class='form-label'>Дробная часть суммы</label> \
                                    <input type='number' class='form-control' name='nano' id='nano' required> \
                                </div> \
                            ";
                            break;
                }
            }
        </script>
    </body>
</html>