@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-home').parent().addClass('selected-button');

        function toogleFlagsErrorsWithout(type = true) {
            let elementList = [
                'math_eq_woe',
                'math_ex_woe',
                'math_co_woe',
                'math_t_woe',
                'math_gt_woe',
                'math_cv_woe'
            ];
            for (let i = 0; i < elementList.length; i++) {
                $('input[name^="' + elementList[i] + '"]').attr('checked', type);
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
                            <div class="col-md-3 card-row-title">
                                Наименование учреждения
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $educational_institution['fullname'] }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                {{ $role['value'] }}
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $teacher['lastname'] }} {{ $teacher['firstname'] }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Класс
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $group['value'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('group-list-return') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку классов">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Предмет
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $subject['value'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('home-subject-list') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку предметов">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
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
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Ученик
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $pupil['lastname'] }} {{ $pupil['firstname'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('home-card-list') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку учеников">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>

                &nbsp;

                <div class="card">
                    <div class="card-header">
                        Карточка ученика
                    </div>

                    <div class="card-body">

                        <form method="POST" name="card" action="{{ route('card-store', $unit_group_pupil_id) }}">
                            @csrf

                            <input type="hidden" name="sub" value="{{ $subject['code'] }}">
                            <input type="hidden" name="subject_id" value="{{ $subject['id'] }}">
                            <input type="hidden" name="group_id" value="{{ $group['id'] }}">
                            <input type="hidden" name="test_id" value="{{ $test['id'] }}">
                            <input type="hidden" name="pupil_id" value="{{ $pupil_id }}">
                            <input type="hidden" name="card_id" value="{{ $card_id }}">

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Оценка
                            </div>
                            <div class="col-md-7 card-row-value">
                                <input type="text" name="range" value="@if(!empty($item['range'])){{ $item['range'] }}@endif" tabindex="1">
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Решение уравнений
                            </div>
                            <div class="col-md-7 card-row-value">
                                <div class="card-row-item">
                                    <input id="math_eq_woe" class="results" group_name="equation" type="checkbox" name="math_eq_woe" @if(!empty($item['math_eq_woe'])) checked @endif tabindex="2">
                                    <label for="math_eq_woe" class="error-without">выполнил задание правильно</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_eq_eis" class="results" group_name="equation" type="checkbox" name="math_eq_eis" @if(!empty($item['math_eq_eis'])) checked @endif tabindex="3">
                                    <label for="math_eq_eis">ошибки в ходе решения</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_eq_eic" class="results" group_name="equation" type="checkbox" name="math_eq_eic" @if(!empty($item['math_eq_eic'])) checked @endif tabindex="4">
                                    <label for="math_eq_eic">ошибки в вычислениях</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_eq_wr" class="results" group_name="equation" type="checkbox" name="math_eq_wr" @if(!empty($item['math_eq_wr'])) checked @endif tabindex="5">
                                    <label for="math_eq_wr">не приступил к решению</label>
                                </div>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Решение выражений
                            </div>
                            <div class="col-md-7 card-row-value">
                                <div class="card-row-item">
                                    <input id="math_ex_woe" class="results" group_name="expression" type="checkbox" name="math_ex_woe" @if(!empty($item['math_ex_woe'])) checked @endif tabindex="6">
                                    <label for="math_ex_woe" class="error-without">выполнил задание правильно</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_ex_eio" class="results" group_name="expression" type="checkbox" name="math_ex_eio" @if(!empty($item['math_ex_eio'])) checked @endif tabindex="7">
                                    <label for="math_ex_eio">ошибки в порядке действий</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_ex_eca" class="results" group_name="expression" type="checkbox" name="math_ex_eca" @if(!empty($item['math_ex_eca'])) checked @endif tabindex="8">
                                    <label for="math_ex_eca">ошибки в вычислениях (сложение)</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_ex_ecs" class="results" group_name="expression" type="checkbox" name="math_ex_ecs" @if(!empty($item['math_ex_ecs'])) checked @endif tabindex="9">
                                    <label for="math_ex_ecs">ошибки в вычислениях (вычитание)</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_ex_ecm" class="results" group_name="expression" type="checkbox" name="math_ex_ecm" @if(!empty($item['math_ex_ecm'])) checked @endif tabindex="10">
                                    <label for="math_ex_ecm">ошибки в вычислениях (умножение)</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_ex_ecd" class="results" group_name="expression" type="checkbox" name="math_ex_ecd" @if(!empty($item['math_ex_ecd'])) checked @endif tabindex="11">
                                    <label for="math_ex_ecd">ошибки в вычислениях (деление)</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_ex_wr" class="results" group_name="expression" type="checkbox" name="math_ex_wr" @if(!empty($item['math_ex_wr'])) checked @endif tabindex="12">
                                    <label for="math_ex_wr">не приступил к решению</label>
                                </div>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Сравнение
                            </div>
                            <div class="col-md-7 card-row-value">
                                <div class="card-row-item">
                                    <input id="math_co_woe" class="results" group_name="comparison" type="checkbox" name="math_co_woe" @if(!empty($item['math_co_woe'])) checked @endif tabindex="13">
                                    <label for="math_co_woe" class="error-without">выполнил задание правильно</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_co_n" class="results" group_name="comparison" type="checkbox" name="math_co_n" @if(!empty($item['math_co_n'])) checked @endif tabindex="14">
                                    <label for="math_co_n">чисел</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_co_ne" class="results" group_name="comparison" type="checkbox" name="math_co_ne" @if(!empty($item['math_co_ne'])) checked @endif tabindex="15">
                                    <label for="math_co_ne">числовых выражений</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_co_dcn" class="results" group_name="comparison" type="checkbox" name="math_co_dcn" @if(!empty($item['math_co_dcn'])) checked @endif tabindex="16">
                                    <label for="math_co_dcn">десятичного состава числа и числа</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_co_en" class="results" group_name="comparison" type="checkbox" name="math_co_en" @if(!empty($item['math_co_en'])) checked @endif tabindex="17">
                                    <label for="math_co_en">выражения и числа</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_co_lv" class="results" group_name="comparison" type="checkbox" name="math_co_lv" @if(!empty($item['math_co_lv'])) checked @endif tabindex="18">
                                    <label for="math_co_lv">величин длины</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_co_mv" class="results" group_name="comparison" type="checkbox" name="math_co_mv" @if(!empty($item['math_co_mv'])) checked @endif tabindex="19">
                                    <label for="math_co_mv">величин массы</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_co_tv" class="results" group_name="comparison" type="checkbox" name="math_co_tv" @if(!empty($item['math_co_tv'])) checked @endif tabindex="20">
                                    <label for="math_co_tv">величин времени</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_co_wr" class="results" group_name="comparison" type="checkbox" name="math_co_wr" @if(!empty($item['math_co_wr'])) checked @endif tabindex="21">
                                    <label for="math_co_wr">не приступил к решению</label>
                                </div>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Задача
                            </div>
                            <div class="col-md-7 card-row-value">
                                <div class="card-row-item">
                                    <input id="math_t_woe" class="results" group_name="task" type="checkbox" name="math_t_woe" @if(!empty($item['math_t_woe'])) checked @endif tabindex="22">
                                    <label for="math_t_woe" class="error-without">выполнил задание правильно</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_t_dd" class="results" group_name="task" type="checkbox" name="math_t_dd" @if(!empty($item['math_t_dd'])) checked @endif tabindex="23">
                                    <label for="math_t_dd">ошибки в ходе решения</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_t_dc" class="results" group_name="task" type="checkbox" name="math_t_dc" @if(!empty($item['math_t_dc'])) checked @endif tabindex="24">
                                    <label for="math_t_dc">ошибки в вычислениях</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_t_wr" class="results" group_name="task" type="checkbox" name="math_t_wr" @if(!empty($item['math_t_wr'])) checked @endif tabindex="25">
                                    <label for="math_t_wr">не приступил к решению</label>
                                </div>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Геометрическая задача
                            </div>
                            <div class="col-md-7 card-row-value">
                                <div class="card-row-item">
                                    <input id="math_gt_woe" class="results" group_name="geometric_task" type="checkbox" name="math_gt_woe" @if(!empty($item['math_gt_woe'])) checked @endif tabindex="26">
                                    <label for="math_gt_woe" class="error-without">выполнил задание правильно</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_gt_dd" class="results" group_name="geometric_task" type="checkbox" name="math_gt_dd" @if(!empty($item['math_gt_dd'])) checked @endif tabindex="27">
                                    <label for="math_gt_dd">ошибки в ходе решения</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_gt_dc" class="results" group_name="geometric_task" type="checkbox" name="math_gt_dc" @if(!empty($item['math_gt_dc'])) checked @endif tabindex="28">
                                    <label for="math_gt_dc">ошибки в вычислениях</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_gt_ded" class="results" group_name="geometric_task" type="checkbox" name="math_gt_ded" @if(!empty($item['math_gt_ded'])) checked @endif tabindex="29">
                                    <label for="math_gt_ded">ошибки в выполнении чертежа</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_gt_wr" class="results" group_name="geometric_task" type="checkbox" name="math_gt_wr" @if(!empty($item['math_gt_wr'])) checked @endif tabindex="30">
                                    <label for="math_gt_wr">не приступил к решению</label>
                                </div>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Перевод величин
                            </div>
                            <div class="col-md-7 card-row-value">
                                <div class="card-row-item">
                                    <input id="math_cv_woe" class="results" group_name="conversion" type="checkbox" name="math_cv_woe" @if(!empty($item['math_cv_woe'])) checked @endif tabindex="31">
                                    <label for="math_cv_woe" class="error-without">выполнил задание правильно</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_cv_l" class="results" group_name="conversion" type="checkbox" name="math_cv_l" @if(!empty($item['math_cv_l'])) checked @endif tabindex="32">
                                    <label for="math_cv_l">длина</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_cv_m" class="results" group_name="conversion" type="checkbox" name="math_cv_m" @if(!empty($item['math_cv_m'])) checked @endif tabindex="33">
                                    <label for="math_cv_m">масса</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_cv_t" class="results" group_name="conversion" type="checkbox" name="math_cv_t" @if(!empty($item['math_cv_t'])) checked @endif tabindex="34">
                                    <label for="math_cv_t">время</label>
                                </div>
                                <div class="card-row-item">
                                    <input id="math_cv_wr" class="results" group_name="conversion" type="checkbox" name="math_cv_wr" @if(!empty($item['math_cv_wr'])) checked @endif tabindex="
                                    35">
                                    <label for="math_cv_wr">не приступил к решению</label>
                                </div>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Исправления
                            </div>
                            <div class="col-md-7 card-row-value">
                                <input type="checkbox" name="math_fx" @if(!empty($item['math_fx'])) checked @endif tabindex="36">
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                <input type="submit" value="Сохранить" tabindex="37">
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
