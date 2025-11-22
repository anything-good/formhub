@if ($form->status == 'published')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400..800&display=swap" rel="stylesheet">

    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    <div class="bg-shape shape-3"></div>

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
        background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 50%, #9ae6b4 100%);
        padding: 2rem 0;
        font-family: 'Baloo Da 2', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* ---------- Animated Background Shapes ---------- */
    .bg-shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.15;
        animation: float 20s infinite ease-in-out;
        z-index: -1;
    }

    .shape-1 {
        width: 300px;
        height: 300px;
        background: #48bb78;
        top: -150px;
        right: -150px;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 200px;
        height: 200px;
        background: #38a169;
        bottom: -100px;
        left: -100px;
        animation-delay: 5s;
    }

    .shape-3 {
        width: 150px;
        height: 150px;
        background: #68d391;
        top: 50%;
        left: 10%;
        animation-delay: 10s;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -30px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    /* ---------- Layout ---------- */
    .modern-form {
        max-width: 650px;
        margin: 2rem auto;
        padding: 1rem;
        position: relative;
        z-index: 1;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 2.5rem 3rem;
        box-shadow: 0 10px 40px rgba(56, 161, 105, 0.15);
        transition: 0.35s ease;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .form-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 50px rgba(56, 161, 105, 0.25);
    }

    .form-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: .5rem;
        color: #22543d;
        text-align: center;
    }

    .form-desc {
        font-size: 1.1rem;
        color: #2f855a;
        margin-bottom: 2.5rem;
        text-align: center;
        line-height: 1.6;
    }

    /* ---------- Fields Divider ---------- */
    .form-field {
        padding-bottom: 1.5rem;
        border-bottom: 1px dashed #c6f6d5;
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
        padding: 1.1rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        background: #f8fff9;
        transition: 0.25s;
        color: #2d3748;
    }

    .floating textarea {
        height: 120px;
        resize: vertical;
    }

    .floating input:focus,
    .floating textarea:focus {
        border-color: #48bb78;
        background: white;
        box-shadow: 0 0 0 4px rgba(72, 187, 120, 0.15);
        outline: none;
    }

    .floating label {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1rem;
        color: #718096;
        pointer-events: none;
        transition: 0.25s;
        background: transparent;
        padding: 0 .35rem;
    }

    .floating input:not(:placeholder-shown)+label,
    .floating textarea:not(:placeholder-shown)+label,
    .floating input:focus+label,
    .floating textarea:focus+label {
        top: -10px;
        font-size: 0.85rem;
        color: #38a169;
        background: white;
        border-radius: 4px;
        font-weight: 600;
    }

    /* ---------- Select ---------- */
    .standard-label {
        font-weight: 600;
        margin-bottom: .6rem;
        display: block;
        color: #22543d;
        font-size: 1.1rem;
    }

    .modern-select {
        width: 100%;
        padding: .9rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        background: #f8fff9;
        transition: 0.25s;
        color: #2d3748;
        cursor: pointer;
    }

    .modern-select:focus {
        border-color: #48bb78;
        box-shadow: 0 0 0 4px rgba(72, 187, 120, 0.15);
        outline: none;
    }

    /* ---------- Checkboxes ---------- */
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: .8rem;
        background: #f8fff9;
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: .8rem;
        padding: .4rem .2rem;
        cursor: pointer;
        transition: 0.2s;
    }

    .checkbox-item:hover {
        color: #2f855a;
    }

    .checkbox-item input[type="checkbox"] {
        width: 1.2rem;
        height: 1.2rem;
        accent-color: #48bb78;
        cursor: pointer;
    }

    /* ---------- Rating ---------- */
    .rating-group {
        display: flex;
        gap: .5rem;
        margin-top: .5rem;
        user-select: none;
        justify-content: center;
        background: #f8fff9;
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .star {
        cursor: pointer;
        font-size: 2.5rem;
        color: #cbd5e0;
        transition: 0.25s;
    }

    .star:hover {
        transform: scale(1.2);
        color: #ecc94b;
    }

    .star.selected {
        color: #ecc94b;
        text-shadow: 0 2px 4px rgba(236, 201, 75, 0.4);
    }

    /* ---------- Button ---------- */
    .submit-btn {
        margin-top: 2rem;
        width: 100%;
        padding: 1.1rem;
        border: none;
        border-radius: 50px;
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
        cursor: pointer;
        background: linear-gradient(135deg, #48bb78, #38a169);
        box-shadow: 0 10px 30px rgba(56, 161, 105, 0.3);
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(56, 161, 105, 0.4);
        background: linear-gradient(135deg, #38a169, #2f855a);
    }

    .submit-btn:active {
        transform: translateY(-1px);
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
        padding: 2rem;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid #c6f6d5;
        box-shadow: 0 10px 30px rgba(56, 161, 105, 0.1);
        animation: fade-in 0.6s ease;
    }

    .form-closed-box h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2f855a;
        margin-bottom: 0.5rem;
    }

    .form-closed-box p {
        font-size: 1.1rem;
        color: #4a5568;
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
