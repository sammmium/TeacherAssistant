@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-home').parent().addClass('selected-button');

        function toogleFlagsErrorsWithout(type = true) {
            let elementList = [
                'equation_1',
                'expression_1',
                'comparison_1',
                'task_1',
                'geometric_task_1',
                'conversion_1'
            ];
            for (let i = 0; i < elementList.length; i++) {
                $('input[name="' + elementList[i] + '"]').attr('checked', type);
            }
        }

        $('input[name="range"]').on('change', function () {
            if ($(this).val() == '10') {
                toogleFlagsErrorsWithout();
            } else {
                toogleFlagsErrorsWithout(false);
            }
        });

        $('input.results').on('click', function (event) {
            let templateName = $(this).attr('group_name');
            if ($(this).attr('name') !== templateName+'_1') {
                if ($('input[name="'+templateName+'_1"]').attr('checked') === 'checked') {
                    if (confirm('Убрать отметку о правильном выполнении задания?')) {
                        $('input[name="'+templateName+'_1"]').attr('checked', false);
                    } else {
                        event.preventDefault();
                        $(this).attr('checked', false);
                    }
                }
            }
        });
    });
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('app.pages.test.title.index') }}</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                Наименование учреждения
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $educational_institution['full_name'] }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                {{ $teacher['job_title'] }}
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $teacher['first_name'] }} {{ $teacher['last_name'] }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                Класс
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $group['name'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('group-list-return') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку классов">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                Предмет
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $subject['name'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('home-subject-list') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку предметов">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                Контрольная работа
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $test['name'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('home-test-list') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку контрольных работ">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                Ученик
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $pupil['last_name'] }} {{ $pupil['first_name'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('home-card-list') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку учеников">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                &nbsp;

                <div class="card">
                    <div class="card-header">
                        Карточка ученика
                    </div>

                    <div class="card-body">

                        <form method="POST" name="card" action="{{ route('home-card-store') }}">
                            @csrf

                            <input type="hidden" name="subject_id" value="{{ $subject['id'] }}">
                            <input type="hidden" name="group_id" value="{{ $group['id'] }}">
                            <input type="hidden" name="test_id" value="{{ $test['id'] }}">
                            <input type="hidden" name="pupil_id" value="{{ $pupil['id'] }}">

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">
                                    Оценка
                                </div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="range" value="" tabindex="1">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">
                                    Решение уравнений
                                </div>
                                <div class="col-md-7 card-row-value">
                                    <div class="card-row-item">
                                        <input id="equation_1" class="results" group_name="equation" type="checkbox" name="eq_woe" value="1" tabindex="2">
                                        <label for="equation_1" class="error-without">выполнил задание правильно</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="equation_2" class="results" group_name="equation" type="checkbox" name="eq_eis" value="1" tabindex="3">
                                        <label for="equation_2">ошибки в ходе решения</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="equation_3" class="results" group_name="equation" type="checkbox" name="eq_eic" value="1" tabindex="4">
                                        <label for="equation_3">ошибки в вычислениях</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="equation_4" class="results" group_name="equation" type="checkbox" name="eq_wr" value="1" tabindex="5">
                                        <label for="equation_4">не приступил к решению</label>
                                    </div>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">
                                    Решение выражений
                                </div>
                                <div class="col-md-7 card-row-value">
                                    <div class="card-row-item">
                                        <input id="expression_1" class="results" group_name="expression" type="checkbox" name="ex_woe" value="1" tabindex="6">
                                        <label for="expression_1" class="error-without">выполнил задание правильно</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="expression_2" class="results" group_name="expression" type="checkbox" name="ex_eio" value="1" tabindex="7">
                                        <label for="expression_2">ошибки в порядке действий</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="expression_3" class="results" group_name="expression" type="checkbox" name="ex_eca" value="1" tabindex="8">
                                        <label for="expression_3">ошибки в вычислениях (сложение)</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="expression_4" class="results" group_name="expression" type="checkbox" name="ex_ecs" value="1" tabindex="9">
                                        <label for="expression_4">ошибки в вычислениях (вычитание)</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="expression_5" class="results" group_name="expression" type="checkbox" name="ex_ecm" value="1" tabindex="10">
                                        <label for="expression_5">ошибки в вычислениях (умножение)</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="expression_6" class="results" group_name="expression" type="checkbox" name="ex_ecd" value="1" tabindex="11">
                                        <label for="expression_6">ошибки в вычислениях (деление)</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="expression_7" class="results" group_name="expression" type="checkbox" name="ex_wr" value="1" tabindex="12">
                                        <label for="expression_7">не приступил к решению</label>
                                    </div>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">
                                    Сравнение
                                </div>
                                <div class="col-md-7 card-row-value">
                                    <div class="card-row-item">
                                        <input id="comparison_1" class="results" group_name="comparison" type="checkbox" name="co_woe" value="1" tabindex="13">
                                        <label for="comparison_1" class="error-without">выполнил задание правильно</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="comparison_2" class="results" group_name="comparison" type="checkbox" name="co_n" value="1" tabindex="14">
                                        <label for="comparison_2">чисел</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="comparison_3" class="results" group_name="comparison" type="checkbox" name="co_ne" value="1" tabindex="15">
                                        <label for="comparison_3">числовых выражений</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="comparison_4" class="results" group_name="comparison" type="checkbox" name="co_dcn" value="1" tabindex="16">
                                        <label for="comparison_4">десятичного состава числа и числа</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="comparison_5" class="results" group_name="comparison" type="checkbox" name="co_en" value="1" tabindex="17">
                                        <label for="comparison_5">выражения и числа</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="comparison_6" class="results" group_name="comparison" type="checkbox" name="co_lv" value="1" tabindex="18">
                                        <label for="comparison_6">величин длины</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="comparison_7" class="results" group_name="comparison" type="checkbox" name="co_mv" value="1" tabindex="19">
                                        <label for="comparison_7">величин массы</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="comparison_8" class="results" group_name="comparison" type="checkbox" name="co_tv" value="1" tabindex="20">
                                        <label for="comparison_8">величин времени</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="comparison_9" class="results" group_name="comparison" type="checkbox" name="co_wr" value="1" tabindex="21">
                                        <label for="comparison_9">не приступил к решению</label>
                                    </div>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">
                                    Задача
                                </div>
                                <div class="col-md-7 card-row-value">
                                    <div class="card-row-item">
                                        <input id="task_1" class="results" group_name="task" type="checkbox" name="t_woe" value="1" tabindex="22">
                                        <label for="task_1" class="error-without">выполнил задание правильно</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="task_2" class="results" group_name="task" type="checkbox" name="t_dd" value="1" tabindex="23">
                                        <label for="task_2">ошибки в ходе решения</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="task_3" class="results" group_name="task" type="checkbox" name="t_dc" value="1" tabindex="24">
                                        <label for="task_3">ошибки в вычислениях</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="task_4" class="results" group_name="task" type="checkbox" name="t_wr" value="1" tabindex="25">
                                        <label for="task_4">не приступил к решению</label>
                                    </div>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">
                                    Геометрическая задача
                                </div>
                                <div class="col-md-7 card-row-value">
                                    <div class="card-row-item">
                                        <input id="geometric_task_1" class="results" group_name="geometric_task" type="checkbox" name="gt_woe" value="1" tabindex="26">
                                        <label for="geometric_task_1" class="error-without">выполнил задание правильно</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="geometric_task_2" class="results" group_name="geometric_task" type="checkbox" name="gt_dd" value="1" tabindex="27">
                                        <label for="geometric_task_2">ошибки в ходе решения</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="geometric_task_3" class="results" group_name="geometric_task" type="checkbox" name="gt_dc" value="1" tabindex="28">
                                        <label for="geometric_task_3">ошибки в вычислениях</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="geometric_task_4" class="results" group_name="geometric_task" type="checkbox" name="gt_ded" value="1" tabindex="29">
                                        <label for="geometric_task_4">ошибки в выполнении чертежа</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="geometric_task_5" class="results" group_name="geometric_task" type="checkbox" name="gt_wr" value="1" tabindex="30">
                                        <label for="geometric_task_5">не приступил к решению</label>
                                    </div>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">
                                    Перевод величин
                                </div>
                                <div class="col-md-7 card-row-value">
                                    <div class="card-row-item">
                                        <input id="conversion_1" class="results" group_name="conversion" type="checkbox" name="cv_woe" value="1" tabindex="31">
                                        <label for="conversion_1" class="error-without">выполнил задание правильно</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="conversion_2" class="results" group_name="conversion" type="checkbox" name="cv_l" value="1" tabindex="32">
                                        <label for="conversion_2">длина</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="conversion_3" class="results" group_name="conversion" type="checkbox" name="cv_m" value="1" tabindex="33">
                                        <label for="conversion_3">масса</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="conversion_4" class="results" group_name="conversion" type="checkbox" name="cv_t" value="1" tabindex="34">
                                        <label for="conversion_4">время</label>
                                    </div>
                                    <div class="card-row-item">
                                        <input id="conversion_5" class="results" group_name="conversion" type="checkbox" name="cv_wr" value="1" tabindex="
                                    35">
                                        <label for="conversion_5">не приступил к решению</label>
                                    </div>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">
                                    Исправления
                                </div>
                                <div class="col-md-7 card-row-value">
                                    <input type="checkbox" name="fx" tabindex="36">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title"></div>
                                <div class="col-md-7 card-row-value">
                                    <input class="btn btn-primary col-md-5" type="submit" value="Сохранить" tabindex="37">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
