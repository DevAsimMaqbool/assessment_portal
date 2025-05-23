@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/%40form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/report.css') }}" />
@endpush
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="container" id="report-content">
                <!-- Header -->
                <header class="text-center mb-5">
                    <h1 class="display-4 text-dark">Virtue Mirror</h1>
                    <button class="btn btn-primary download-btn" onclick="downloadPDF()">Download as PDF</button>
                </header>

                <!-- Employee Information -->
                <section class="mb-5">

                    <div class="row">
                        <h2 class="section-info">Employee Information</h2>
                        <div class="col-md-6 mb-3"><strong>Name:</strong> Your Name</div>
                        <div class="col-md-6 mb-3"><strong>Employee ID:</strong> Your ID</div>
                        <div class="col-md-6 mb-3"><strong>Designation:</strong> Your Designation</div>
                        <div class="col-md-6 mb-3"><strong>Department:</strong> Your Department</div>
                        <div class="col-md-6 mb-3"><strong>Unit/Campus:</strong> Your Unit/Campus</div>
                        <div class="col-md-6 mb-3"><strong>Date of Report:</strong> Report Date</div>
                    </div>
                </section>

                <!-- Purpose of the Report -->
                <section class="mb-5">
                    <h2 class="section-title">Purpose of the Report</h2>
                    <p class="text-muted">
                        This report provides a personalized snapshot of character development, combining self-assessment and
                        stakeholder feedback to identify strengths and areas for growth. It highlights the role of character
                        in
                        enhancing leadership, relationships, and service, and aims to deepen self-awareness and foster
                        meaningful
                        development. Perception gaps may emerge; <b>positive gaps</b> indicate alignment between self-view
                        and
                        others'
                        perceptions, while <b>negative gaps</b> reflect a disconnect, where individuals see themselves
                        differently
                        from how
                        others experience them. These gaps may stem from factors like communication style, role
                        expectations, or
                        situational behavior. To bridge them, the report suggests strategies such as seeking feedback,
                        reflecting
                        regularly, clarifying expectations, and practicing consistent behavior. All findings are
                        confidential and
                        should not be shared without the individual's consent.
                    </p>
                </section>

                <!-- Overview -->
                <section class="mb-5">
                    <h2 class="section-title">Overview</h2>
                    <div class="page-break"></div>
                    <!-- Inside Mirror -->
                    <div class="sub-section">
                        <h3 class="h4 text-dark">Inside Mirror (Self-Assessment)</h3>
                        <div class="table-responsive">
                            <table class="table border-top">
                                <thead>
                                    <tr class="td-bg-blk">
                                        <th class="text-color">Character Dimension</th>
                                        <th class="text-color">Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td-bg">Responsibility & Accountability</td>
                                        <td>You rated yourself at 83%, which reflects a strong sense of ownership and
                                            dependability. This score places this virtue as your 2nd highest strength in
                                            self-
                                            perception, indicating that you see yourself as someone who takes commitments
                                            seriously and follows through with consistency.</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Honesty & Integrity</td>
                                        <td>Your self-assessment stands at 78%, suggesting a stable personal commitment to
                                            truthfulness and ethical behavior. This rating places this trait 3rd in your
                                            self-evaluation,
                                            reflecting a belief that you generally act with fairness and moral clarity,
                                            though there
                                            may still be moments where deeper consistency can be pursued.</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Empathy &
                                            Compassion</td>
                                        <td>You rated yourself at 89%, the lowest-ranked score in your self-assessment
                                            despite
                                            being numerically high. This suggests that you see empathy and compassion as
                                            central
                                            to your leadership approach, possibly indicating your own high expectations for
                                            emotional intelligence and connection with others.</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Humility & Service</td>
                                        <td>With a self-assessment score of 93%, this is the highest-rated virtue in your
                                            own view.
                                            You see yourself as someone who prioritizes collective well-being, values
                                            others’
                                            contributions, and leads with humility and a spirit of service.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Patience & Gratitude</td>
                                        <td>You rated yourself at 62%, placing this as your 4th out of 5 traits. This score
                                            indicates
                                            that while you may demonstrate patience and appreciation in some settings, you
                                            also
                                            recognize room for growth in consistently applying these qualities under stress
                                            or in
                                            fast-paced situations.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="page-break"></div>
                    <!-- Social Mirror -->
                    <div class="sub-section">
                        <h3 class="h4 text-dark">Social Mirror (Stakeholders' Perception)</h3>
                        <div class="table-responsive">
                            <table class="table border-top">
                                <thead>
                                    <tr class="td-bg-blk">
                                        <th class="text-color">Character Dimension</th>
                                        <th class="text-color">Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td-bg">Responsibility & Accountability</td>
                                        <td>Stakeholders rated you at 87%, reflecting a strong perception of you as
                                            dependable,
                                            committed, and trustworthy. You are viewed as someone who takes ownership of
                                            responsibilities and consistently follows through on commitments.</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Honesty & Integrity</td>
                                        <td>With a rating of 76%, stakeholders see you as honest and principled, suggesting
                                            that you
                                            demonstrate fairness, reliability, and ethical behavior in your interactions and
                                            decisions.</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Empathy &
                                            Compassion</td>
                                        <td>Stakeholders rated this trait at 63%, indicating that while some elements of
                                            care and
                                            emotional awareness are recognized, there may be opportunities to express
                                            greater
                                            empathy and attentiveness in daily interactions.</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Humility & Service</td>
                                        <td>Scoring an impressive 97%, this is the most highly rated dimension from your
                                            colleagues.
                                            You are perceived as a humble, selfless, and service-driven individual who
                                            consistently
                                            uplifts others and contributes to a collaborative and respectful environment.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Patience & Gratitude</td>
                                        <td>With a stakeholder score of 71%, you are seen as someone who generally exhibits
                                            calmness under pressure and appreciation for others. This reflects a positive
                                            contribution to team morale and emotional resilience in the workplace.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="sub-section">
                        <div class="table-responsive">
                            <table class="table border-top">
                                <thead>
                                    <tr class="td-bg-blk">
                                        <th class="text-color">Character Dimension</th>
                                        <th class="text-color">Self-Assessment</th>
                                        <th class="text-color">Stakeholders’
                                            Perception</th>
                                        <th class="text-color">Mean</th>
                                        <th class="text-color">Perception Gap</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td-bg">Responsibility & Accountability</td>
                                        <td>83%</td>
                                        <td>87%</td>
                                        <td>85%</td>
                                        <td>4%</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Honesty & Integrity</td>
                                        <td>78%</td>
                                        <td>76%</td>
                                        <td>77%</td>
                                        <td>-2%</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Empathy &
                                            Compassion</td>
                                        <td>89%</td>
                                        <td>63%</td>
                                        <td>76%</td>
                                        <td>-26%</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Humility & Service</td>
                                        <td>93%</td>
                                        <td>97%</td>
                                        <td>95%</td>
                                        <td>4%</td>
                                    </tr>
                                    <tr>
                                        <td class="td-bg">Patience & Gratitude</td>
                                        <td>62%</td>
                                        <td>71%</td>
                                        <td>67%</td>
                                        <td>9%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <div class="page-break"></div>
                <!-- Summary -->
                <section class="mb-5">
                    <h2 class="section-title">Summary</h2>
                    <h3 class="h4 text-dark">Description</h3>
                    <div class="table-responsive">
                        <table class="table border-top">
                            <thead>
                                <tr class="td-bg-blk">
                                    <th class="text-color">Character Dimension</th>
                                    <th class="text-color">Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td-bg">Responsibility & Accountability</td>
                                    <td>You rated yourself at 83%, while your stakeholders scored you slightly higher at
                                        87%. This
                                        indicates a positive perception gap, suggesting that others view you as even more
                                        responsible and accountable than you perceive yourself to be. Your self-assessment
                                        ranks you
                                        2nd out of 5 in this area, while stakeholder feedback places you at the performance
                                        level of
                                        EE - Exceeds Expectations.</td>
                                </tr>
                                <tr>
                                    <td class="td-bg">Honesty & Integrity</td>
                                    <td>Your self-assessment stands at 78%, compared to a stakeholder rating of 76%. This
                                        reflects a
                                        minor negative perception gap, where you view yourself marginally more favorably
                                        than your
                                        colleagues do. You rank 3rd out of 5 based on your own evaluation, and stakeholders
                                        assess
                                        your performance as ME - Meets Expectations.</td>
                                </tr>
                                <tr>
                                    <td class="td-bg">Empathy & Compassion</td>
                                    <td>You assessed yourself at 89%, whereas your stakeholders rated you significantly
                                        lower at
                                        63%. This highlights a notable negative perception gap, indicating a clear
                                        misalignment—you
                                        believe you excel in this virtue more than your colleagues perceive. According to
                                        your
                                        self-evaluation, you rank 5th out of 5, while stakeholder feedback places you at NI
                                        - Needs
                                        Improvement.</td>
                                </tr>
                                <tr>
                                    <td class="td-bg">Humility & Service</td>
                                    <td>With a self-assessment score of 93% and a stakeholder score of 97%, this area
                                        reflects a
                                        strong positive perception gap. Your peers recognize and value your humility and
                                        commitment
                                        to service even more than you do. You rank 1st out of 5 in your self-rating, and
                                        stakeholders have placed you at OS - Outstanding.</td>
                                </tr>
                                <tr>
                                    <td class="td-bg">Patience & Gratitude</td>
                                    <td>You rated yourself at 62%, while stakeholders offered a higher score of 71%. This
                                        indicates
                                        a positive perception gap, showing that your colleagues recognize a greater presence
                                        of
                                        patience and gratitude in your behavior than you acknowledge in yourself. Based on
                                        your
                                        self-assessment, you rank 4th out of 5, with stakeholder feedback aligning your
                                        performance
                                        at ME - Meets Expectations.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="sub-section">
                        <div class="table-responsive">
                            <table class="table border-top">
                                <thead>
                                    <tr class="td-bg-blk">
                                        <th class="text-color">Key Strengths</th>
                                        <th class="text-color">Areas for Improvement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td-bg">
                                            1. Humility & Service<br>
                                            2. Responsibility & Accountability<br>
                                            3. Honesty & Integrity
                                        </td>
                                        <td class="td-bg">
                                            1. Empathy & Compassion<br>
                                            2. Patience & Gratitude
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Key Strengths -->
                <section class="mb-5">
                    <h2 class="section-title">Key Strengths</h2>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">
                            <strong>Humility & Service:</strong>
                            <p class="text-muted">Humility and service stand out as key strengths in your overall profile.
                                Your
                                self-assessment reflects a grounded, sincere approach to your work, while feedback from
                                colleagues
                                indicates that your contributions leave a meaningful impact on those around you. Even when
                                you may
                                see your actions
                            <div class="page-break"></div> as routine or modest, others view them as uplifting, supportive,
                            and
                            reflective of
                            a strong sense of character...</p>
                            <ul class="list-group">
                                <li class="list-group-item">Lead by example - Show consistent care and support for others,
                                    putting
                                    team needs ahead of personal recognition.</li>
                                <li class="list-group-item">Acknowledge contributions - Highlight and appreciate the efforts
                                    of
                                    those around you in group settings.</li>
                                <li class="list-group-item">Celebrate collective wins - Emphasize team achievements over
                                    individual
                                    successes to strengthen a sense of unity.</li>
                                <li class="list-group-item">Practice active listening - Create space for others to share
                                    ideas and
                                    perspectives without judgment.</li>
                                <li class="list-group-item">Encourage and uplift - Recognize the strengths of colleagues and
                                    offer
                                    encouragement where it's needed.</li>
                                <li class="list-group-item">Welcome feedback - Stay open to input and use it as a tool for
                                    personal
                                    and professional development.</li>
                            </ul>
                            <p class="text-muted mt-2">For further insight, "Chapter 9: Humility and Service-The Essence of
                                Selfless
                                Leadership" in <em>Cultivating Leadership Character</em> by Prof. Dr. Chaudhry Abdul Rehman
                                offers
                                practical ideas on developing humility as a lifelong strength.</p>
                        </li>
                        <li class="list-group-item">
                            <strong>Responsibility & Accountability:</strong>
                            <p class="text-muted">Responsibility and accountability stand out as strong aspects of your
                                character.
                                Your self-assessment shows a steady commitment to owning your actions and decisions, and
                                interestingly, those around you see this even more strongly, valuing your ability to
                                consistently
                                follow through and handle challenges with integrity.<br>This strength holds deep meaning
                                both personally and professionally. In your personal sphere, it
                                reflects emotional maturity, a willingness to learn from experiences, and a genuine sense of
                                dependability that others naturally trust. Professionally, it creates a reliable
                                presence—someone who
                                delivers on commitments, fosters mutual respect, and contributes to a culture of trust and
                                shared
                                ownership.
                            <div class="page-break"></div>To continue nurturing this trait and maximizing its impact, you
                            might consider incorporating these
                            practices into your everyday approach:</p>
                            <ul class="list-group">
                                <li class="list-group-item">Be transparent in your decision-making - Share the reasoning
                                    behind your
                                    actions so others can understand the thought process and values that guide you.</li>
                                <li class="list-group-item">Take ownership of challenges - When outcomes don't go as
                                    planned, take
                                    initiative in finding solutions and learning from the situation.</li>
                                <li class="list-group-item">Model mutual accountability - Demonstrate your commitment to
                                    responsibility while encouraging the same from those around you.</li>
                                <li class="list-group-item">Clarify expectations early - Communicate goals and
                                    responsibilities
                                    clearly to avoid misunderstandings and promote alignment.</li>
                                <li class="list-group-item">Follow through consistently - Build trust by honoring deadlines,
                                    keeping
                                    your word, and completing tasks as promised.</li>
                                <li class="list-group-item">Make time for reflection - Regularly assess your actions and
                                    decisions,
                                    identifying both successes and areas for growth.</li>
                            </ul>
                            <p class="text-muted mt-2">For deeper insights, "Chapter 5: Responsibility and
                                Accountability-The Weight
                                of Leadership" in <em>Cultivating Leadership Character</em> by Prof. Dr. Chaudhry Abdul
                                Rehman
                                offers thoughtful guidance.</p>
                        </li>
                        <li class="list-group-item">
                            <strong>Empathy & Compassion:</strong>
                            <p class="text-muted">Your journey reveals a thoughtful inclination toward empathy and
                                compassion—values that shape
                                meaningful human connection and elevate the quality of our everyday interactions. While your
                                own
                                perception of this strength might be modest, the feedback from those around you affirms its
                                presence
                                and positive impact. These qualities are not only felt but appreciated by those who interact
                                with you.
                                Empathy allows you to truly connect, helping you sense what others are feeling even when
                                it’s
                                unspoken. Compassion takes that awareness a step further, prompting acts of kindness and
                                support that
                                make people feel seen, safe, and understood. Personally, these traits foster warmth, trust,
                                and deeper
                                relationships. Professionally, they promote psychological safety, enhance teamwork, and
                                strengthen
                                communication in even the most demanding environments.<br>
                                As you continue to grow in this area, being more intentional in how you express empathy and
                                compassion can make a significant difference. Here are some approaches to consider:</p>
                            <ul class="list-group">
                                <li class="list-group-item">Pause to truly listen – Create space in conversations for others
                                    to share fully, without
                                    interrupting or jumping to solve.</li>
                                <li class="list-group-item">Ask thoughtful questions – Express interest in others’ realities
                                    by inquiring with care and
                                    curiosity.</li>
                                <li class="list-group-item">Notice emotional cues – Pay attention to non-verbal signals like
                                    tone and body language
                                    to understand what may not be said outright.</li>
                                <li class="list-group-item">Practice perspective-taking – Make a conscious effort to imagine
                                    situations from others’
                                    viewpoints, especially during conflict or misalignment.</li>
                                <li class="list-group-item">Be generous in assumptions – When people falter, consider that
                                    there may be invisible
                                    burdens rather than immediately attributing fault.</li>
                                <li class="list-group-item">Create time for connection – Engage in informal check-ins or
                                    simple interactions that
                                    show you're present beyond the tasks at hand.</li>
                                <li class="list-group-item">Practice patience – Extend understanding when others are
                                    navigating stress or hardship,
                                    even if their performance is affected.</li>
                                <li class="list-group-item">Show genuine care – Small, sincere gestures—asking how someone
                                    is really doing,
                                    remembering something important to them—can go a long way.</li>
                                <li class="list-group-item">Regulate your own emotions – In tense moments, take a breath
                                    before reacting, and
                                    respond in a way that communicates calm and care.</li>
                                <li class="list-group-item">Invite relational feedback – Ask trusted peers how your empathy
                                    comes across to them,
                                    and where you might improve in showing up more fully.</li>
                            </ul>
                            <p class="text-muted mt-2">For a deeper dive, see “Chapter 8: Empathy and Compassion – The Heart
                                of Prophetic Leadership”
                                in Cultivating Leadership Character by Prof. Dr. Chaudhry Abdul Rehman. It offers valuable
                                guidance on how empathy and compassion not only enhance individual growth but also transform
                                collective experiences.
                                By embodying these traits with intention, you reinforce that people matter—not just for what
                                they
                                do, but for who they are. Strengthening empathy and compassion enriches both your personal
                                journey and your capacity to contribute meaningfully to the lives and work of others.</p>
                        </li>
                    </ol>
                </section>

                <!-- Areas for Development -->
                <section class="mb-5">
                    <h2 class="section-title">Areas for Development</h2>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">
                            <strong>Honesty & Integrity:</strong>
                            <p class="text-muted">While you demonstrate a foundational understanding of honesty and
                                integrity, there
                                remains significant potential to deepen and consistently embody these traits across diverse
                                professional and interpersonal scenarios...</p>
                            <ul class="list-group">
                                <li class="list-group-item">Acknowledge and reflect on ethical dilemmas - Take time to
                                    analyze
                                    situations where integrity is tested, both personally and professionally.</li>
                                <li class="list-group-item">Build the courage to give and receive honest feedback - Foster a
                                    culture
                                    of trust in your relationships and workplace by communicating openly.</li>
                                <li class="list-group-item">Stay consistent in principles under pressure - Practice ethical
                                    decision-making, even in high-stakes or uncomfortable environments.</li>
                                <li class="list-group-item">Seek clarity on your values - Regularly revisit your core
                                    principles and
                                    assess how your actions align with them.</li>
                                <li class="list-group-item">Be transparent about limitations and mistakes - Admitting when
                                    you don't
                                    know something or when you've made an error builds respect and trust.</li>
                                <li class=" Sheldon: list-group-item">Avoid rationalizing unethical behavior - Resist the
                                    urge to
                                    justify shortcuts or omissions for convenience or gain.</li>
                            </ul>
                            <p class="text-muted mt-2">For a deeper exploration, refer to Chapter 4: Honesty and The
                                Foundation of
                                Trustworthy Leadership in <em>Cultivating Leadership Character</em> by Prof. Dr. Chaudhry
                                Abdul
                                Rehman.</p>
                        </li>
                        <li class="list-group-item">
                            <strong>Patience & Gratitude:</strong>
                            <p class="text-muted">Patience and gratitude are essential qualities for navigating challenges
                                and
                                maintaining a positive outlook, especially in the face of adversity...</p>
                            <ul class="list-group">
                                <li class="list-group-item">Practice mindful breathing or meditation - Use relaxation
                                    techniques to
                                    calm yourself in moments of stress, cultivating patience and composure.</li>
                                <li class="list-group-item">Recognize the value in challenges - When faced with difficult
                                    situations, remind yourself of the opportunities for growth and learning they present.
                                </li>
                                <li class="list-group-item">Express gratitude regularly - Make a habit of thanking others
                                    for their
                                    contributions, both big and small.</li>
                                <li class="list-group-item">Be slow to react - When frustration arises, pause to reflect
                                    before
                                    responding, giving yourself the time needed for thoughtful and patient action.</li>
                                <li class="list-group-item">Find moments of joy in the mundane - Practice gratitude by
                                    appreciating
                                    the small, everyday moments that bring value to your work and life.</li>
                                <li class="list-group-item">Focus on the present - Avoid stressing over past mistakes or
                                    future
                                    uncertainties; stay grounded in the present.</li>
                            </ul>
                            <p class="text-muted mt-2">For a deeper exploration, refer to Chapter 7: Patience and
                                Gratitude-Twin
                                Pillars of Resilient Leadership in <em>Cultivating Leadership Character</em> by Prof. Dr.
                                Chaudhry
                                Abdul Rehman.</p>
                            <p class="text-muted">This chapter provides valuable insights into how patience
                                and gratitude can significantly enhance your leadership approach and emotional resilience.
                            </p>
                            <p class="text-muted">By consciously applying these strategies, you will strengthen both your
                                emotional resilience and
                                your ability to navigate challenges with a calm and positive mindset. Cultivating patience
                                and
                                gratitude will contribute to a more harmonious and productive leadership environment,
                                enhancing
                                not only your personal growth but also your professional effectiveness.
                            </p>
                        </li>
                    </ol>
                </section>

                <!-- Conclusion -->
                <section class="mb-5">
                    <h2 class="section-title">Conclusion</h2>
                    <p class="text-muted">
                        This report offers a comprehensive view of your character development by integrating self-reflection
                        with
                        community feedback. The alignment and gaps between these perspectives provide critical insights into
                        how
                        your character is perceived and the impact it creates. Strengths in Humility & Service and
                        Responsibility &
                        Accountability indicate a strong foundation for principled leadership aligned with Superior
                        University's
                        values. Opportunities for growth in Empathy & Compassion and Patience & Gratitude highlight areas
                        that, when
                        nurtured, can further enhance your personal and professional effectiveness. Leadership rooted in
                        character
                        is a continuous journey; this report serves as a guide to help you reflect, recalibrate, and commit
                        to
                        embodying the virtues that define transformational and value-driven leadership.
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/%40form-validation/popular.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/%40form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/%40form-validation/auto-focus.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admin/assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
@endpush
@push('script')
    <script>
        function downloadPDF() {
            const element = document.getElementById('report-content');

            const opt = {
                margin: [0.5, 0.5, 0.5, 0.5], // top, left, bottom, right
                filename: 'Virtue_Mirror_Report.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
            };

            html2pdf().set(opt).from(element).save();
        }

    </script>
@endpush