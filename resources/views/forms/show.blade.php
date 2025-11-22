@if ($form->status == 'published')



    <form action="/forms/{{ $form->id }}/submit" method="POST" class="modern-form">
        @csrf

        <div class="form-card">
            <h2 class="form-title">{{ $form->title }}</h2>
            <p class="form-desc">{{ $form->description }}</p>

            @foreach ($form->fields as $field)
                <div class="form-field">

                    {{-- TEXT / DATE / TIME / DATETIME --}}
                    @if (in_array($field->type, ['text', 'date', 'time', 'datetime']))
                        @php
                            $htmlType =
                                $field->type === 'datetime'
                                    ? 'datetime-local'
                                    : ($field->type === 'date'
                                        ? 'date'
                                        : ($field->type === 'time'
                                            ? 'time'
                                            : 'text'));
                        @endphp

                        <div class="floating">
                            <input type="{{ $htmlType }}" id="field-{{ $field->id }}"
                                name="field_{{ $field->id }}"
                                value="{{ old('field_' . $field->id, $field->value ?? '') }}" placeholder=" " />
                            <label for="field-{{ $field->id }}">{{ $field->label }}</label>
                        </div>

                        {{-- TEXTAREA --}}
                    @elseif ($field->type === 'textarea')
                        <div class="floating">
                            <textarea id="field-{{ $field->id }}" name="field_{{ $field->id }}" placeholder=" ">{{ old('field_' . $field->id, $field->value ?? '') }}</textarea>
                            <label for="field-{{ $field->id }}">{{ $field->label }}</label>
                        </div>

                        {{-- DROPDOWN --}}
                    @elseif ($field->type === 'dropdown')
                        <label class="standard-label">{{ $field->label }}</label>
                        <select id="field-{{ $field->id }}" name="field_{{ $field->id }}" class="modern-select">
                            @foreach ($field->options ?? [] as $option)
                                <option value="{{ $option->value }}"
                                    {{ old('field_' . $field->id, $field->value ?? '') == $option->value ? 'selected' : '' }}>
                                    {{ $option->label }}
                                </option>
                            @endforeach
                        </select>

                        {{-- CHECKBOX GROUP --}}
                    @elseif ($field->type === 'checkbox')
                        <label class="standard-label">{{ $field->label }}</label>
                        <div class="checkbox-group">
                            @foreach ($field->options ?? [] as $option)
                                <label class="checkbox-item">
                                    <input type="checkbox" name="field_{{ $field->id }}[]"
                                        value="{{ $option->value }}"
                                        {{ in_array($option->value, old('field_' . $field->id, $field->value ?? [])) ? 'checked' : '' }}>
                                    <span>{{ $option->label }}</span>
                                </label>
                            @endforeach
                        </div>

                        {{-- RATING --}}
                    @elseif ($field->type === 'rating')
                        <label class="standard-label">{{ $field->label }}</label>
                        <div class="rating-group" data-field-id="{{ $field->id }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" class="rating-input"
                                    id="rating-{{ $field->id }}-{{ $i }}"
                                    name="field_{{ $field->id }}" value="{{ $i }}"
                                    {{ (int) old('field_' . $field->id, $field->value ?? 0) === $i ? 'checked' : '' }}>
                                <label class="star" for="rating-{{ $field->id }}-{{ $i }}"
                                    data-value="{{ $i }}">★</label>
                            @endfor
                        </div>
                    @elseif ($field->type === 'email')
                        <div class="floating">
                            <input type="email" id="field-{{ $field->id }}" name="field_{{ $field->id }}"
                                placeholder=" " value="{{ old('field_' . $field->id, $field->value ?? '') }}" />
                            <label for="field-{{ $field->id }}">{{ $field->label }}</label>
                        </div>


                        {{-- FALLBACK --}}
                    @else
                        <div class="floating">
                            <input type="text" id="field-{{ $field->id }}" name="field_{{ $field->id }}"
                                placeholder=" " value="{{ old('field_' . $field->id, $field->value ?? '') }}" />
                            <label for="field-{{ $field->id }}">{{ $field->label }}</label>
                        </div>
                    @endif
                </div>
            @endforeach

            <button type="submit" class="submit-btn">Submit</button>
        </div>
    </form>
@else
    <div class="form-card closed-form-card glass-card">
        <div class="closed-icon">🚫</div>

        <h2 class="form-title">{{ $form->title }}</h2>
        <p class="form-desc">{{ $form->description }}</p>

        <div class="form-closed-box">
            <h3>Form Unavailable</h3>
            <p>This form is currently closed and not accepting responses.</p>
        </div>
    </div>
@endif


<style>
    /* ---------- Page Background ---------- */
    body {
        background: linear-gradient(135deg, #ece9ff, #f8f7ff);
        padding: 2rem 0;
        font-family: 'Inter', sans-serif;
    }

    /* ---------- Layout ---------- */
    .modern-form {
        max-width: 650px;
        margin: 2rem auto;
        padding: 1rem;
    }

    .form-card {
        background: #fff;
        border-radius: 16px;
        padding: 2.2rem 2.6rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transition: 0.35s ease;
    }

    .form-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    }

    .form-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: .5rem;
        background: linear-gradient(135deg, #6b5eff, #4f3aff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .form-desc {
        font-size: 1.05rem;
        color: #666;
        margin-bottom: 2rem;
    }

    /* ---------- Fields Divider ---------- */
    .form-field {
        padding-bottom: 1rem;
        border-bottom: 1px dashed #eee;
        margin-bottom: 1.5rem;
    }

    .form-field:last-child {
        border-bottom: none;
    }

    /* ---------- Floating Inputs ---------- */
    .floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .floating input,
    .floating textarea {
        width: 100%;
        padding: 1rem .9rem;
        border: 2px solid #ddd;
        border-radius: 10px;
        font-size: 1rem;
        background: none;
        transition: 0.25s;
    }

    .floating textarea {
        height: 120px;
        resize: vertical;
    }

    .floating input:focus,
    .floating textarea:focus {
        border-color: #6b5eff;
        box-shadow: 0 0 0 3px rgba(107, 94, 255, 0.15);
    }

    .floating label {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.95rem;
        color: #777;
        pointer-events: none;
        transition: 0.25s;
        background: white;
        padding: 0 .35rem;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .floating input:not(:placeholder-shown)+label,
    .floating textarea:not(:placeholder-shown)+label,
    .floating input:focus+label,
    .floating textarea:focus+label {
        top: -9px;
        font-size: 0.75rem;
        color: #6b5eff;
    }

    /* ---------- Select ---------- */
    .standard-label {
        font-weight: 600;
        margin-bottom: .4rem;
        display: block;
    }

    .modern-select {
        width: 100%;
        padding: .8rem;
        border: 2px solid #ddd;
        border-radius: 10px;
        font-size: 1rem;
        background: white;
        transition: 0.25s;
    }

    .modern-select:focus {
        border-color: #6b5eff;
        box-shadow: 0 0 0 3px rgba(107, 94, 255, 0.15);
    }

    /* ---------- Checkboxes ---------- */
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: .5rem;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: .5rem;
        padding: .4rem .2rem;
    }

    /* ---------- Rating ---------- */
    .rating-group {
        display: flex;
        gap: .25rem;
        margin-top: .3rem;
        user-select: none;
    }

    .star {
        cursor: pointer;
        font-size: 2rem;
        color: #ccc;
        transition: 0.25s;
    }

    .star:hover {
        transform: scale(1.15);
        color: gold;
    }

    .star.selected {
        color: gold;
        text-shadow: 0 0 10px rgba(255, 200, 0, 0.6);
    }

    /* ---------- Button ---------- */
    .submit-btn {
        margin-top: 1.5rem;
        width: 100%;
        padding: 0.9rem;
        border: none;
        border-radius: 14px;
        font-size: 1.15rem;
        font-weight: 700;
        color: white;
        cursor: pointer;
        background: linear-gradient(135deg, #6b5eff, #4f3aff);
        background-size: 200%;
        background-position: left;
        transition: 0.35s ease;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        background-position: right;
        box-shadow: 0 8px 18px rgba(107, 94, 255, 0.4);
    }

    .rating-input {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        display: none !important;
    }

    /* ---------- Closed Form Styling ---------- */
    .closed-form-card {
        text-align: center;
        padding-top: 3rem;
        padding-bottom: 3rem;
        position: relative;
    }

    .closed-icon {
        font-size: 4rem;
        margin-bottom: 1.2rem;
        animation: soft-bounce 1.5s infinite ease-in-out;
    }

    @keyframes soft-bounce {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-6px);
        }

        100% {
            transform: translateY(0);
        }
    }

    .form-closed-box {
        margin-top: 2rem;
        padding: 1.7rem;
        border-radius: 14px;
        background: #f9f2ff;
        border: 1.5px solid #e5d8ff;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        animation: fade-in 0.6s ease;
    }

    .form-closed-box h3 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #6b5eff;
        margin-bottom: 0.5rem;
    }

    .form-closed-box p {
        font-size: 1.05rem;
        color: #555;
    }

    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }



    /* ---------- Glassmorphism Closed Form ---------- */
    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        padding: 3rem 2.5rem;
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        color: #fff;
        text-align: center;
        transition: 0.35s ease;
    }

    .glass-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 36px rgba(0, 0, 0, 0.2);
    }

    .closed-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        animation: soft-bounce 1.5s infinite ease-in-out;
    }

    /* Floating Bounce Animation */
    @keyframes soft-bounce {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-6px);
        }

        100% {
            transform: translateY(0);
        }
    }

    /* Glass Box Inside Card */
    .form-closed-box {
        margin-top: 2rem;
        padding: 2rem;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
        animation: fade-in 0.6s ease;
    }

    .form-closed-box h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ffddf0;
        margin-bottom: 0.5rem;
    }

    .form-closed-box p {
        font-size: 1.05rem;
        color: #e6e6e6;
    }

    /* Fade-in animation for box */
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Optional: make the card’s background gradient softly visible */
    body {
        background: linear-gradient(135deg, #6b5eff, #a56bff);
        padding: 2rem 0;
        font-family: 'Inter', sans-serif;
    }
</style>

<script>
    document.querySelectorAll('.rating-group').forEach(group => {
        const labels = [...group.querySelectorAll('.star')];
        const inputs = [...group.querySelectorAll('.rating-input')];

        function updateStars() {
            const checked = group.querySelector('input:checked');
            const selected = checked ? parseInt(checked.value) : 0;
            labels.forEach(label => {
                const v = parseInt(label.dataset.value);
                label.classList.toggle('selected', v <= selected);
            });
        }

        labels.forEach(label => {
            label.addEventListener('click', () => {
                const input = document.getElementById(label.getAttribute('for'));
                input.checked = true;
                input.dispatchEvent(new Event('change'));
                updateStars();
            });
        });

        inputs.forEach(input => input.addEventListener('change', updateStars));
        updateStars();
    });
</script>
