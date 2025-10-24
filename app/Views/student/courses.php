<?= $this->extend('template') ?>
<?= $this->section('styles') ?>
<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
.enroll-btn {
    transition: all 0.3s ease;
}
.enroll-btn:hover {
    transform: translateY(-2px);
}
.enrolled-badge {
    position: absolute;
    top: 10px;
    right: 10px;
}
.fade-in {
    animation: fadeIn 0.5s ease-in;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">My Courses</h3>
        <a href="<?= site_url('/dashboard') ?>" class="btn btn-secondary btn-sm">Back to Dashboard</a>
    </div>

    <!-- Alert for messages -->
    <div id="alertContainer"></div>

    <!-- Enrolled Courses Section -->
    <div class="mb-5">
        <h4 class="mb-3"><i class="fas fa-graduation-cap me-2"></i>Enrolled Courses (<span id="enrolledCount"><?= count($enrolledCourses) ?></span>)</h4>
        <div id="enrolledCoursesContainer">
            <?php if (!empty($enrolledCourses)): ?>
                <div class="row g-3" id="enrolledCoursesList">
                    <?php foreach ($enrolledCourses as $course): ?>
                        <div class="col-md-6 col-lg-4" id="enrolled-course-<?= $course['course_id'] ?>">
                            <div class="card h-100 position-relative">
                                <span class="badge bg-success enrolled-badge">Enrolled</span>
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($course['course_title']) ?></h5>
                                    <p class="card-text"><?= esc($course['description']) ?></p>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        Enrolled: <?= date('M j, Y', strtotime($course['enrollment_date'])) ?>
                                    </small>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary btn-sm">View Materials</button>
                                    <button class="btn btn-outline-secondary btn-sm">Assignments</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info" id="noEnrolledCoursesAlert">
                    <i class="fas fa-info-circle me-2"></i>
                    You are not enrolled in any courses yet. Check out the available courses below!
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Available Courses Section -->
    <div class="mb-5">
        <h4 class="mb-3"><i class="fas fa-book me-2"></i>Available Courses</h4>
        <?php if (!empty($availableCourses)): ?>
            <div class="row g-3" id="availableCoursesList">
                <?php foreach ($availableCourses as $course): ?>
                    <div class="col-md-6 col-lg-4" id="available-course-<?= $course['id'] ?>">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title" data-course-title="<?= esc($course['title']) ?>"><?= esc($course['title']) ?></h5>
                                <p class="card-text" data-course-description="<?= esc($course['description']) ?>"><?= esc($course['description']) ?></p>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>
                                    Instructor ID: <?= esc($course['instructor_id']) ?>
                                </small>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success enroll-btn" 
                                        data-course-id="<?= $course['id'] ?>"
                                        data-course-title="<?= esc($course['title']) ?>"
                                        data-course-description="<?= esc($course['description']) ?>"
                                        id="enroll-btn-<?= $course['id'] ?>">
                                    <i class="fas fa-plus me-1"></i>Enroll
                                </button>
                                <button class="btn btn-outline-info btn-sm">View Details</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                No available courses at the moment, or you are enrolled in all available courses!
            </div>
        <?php endif; ?>
    </div>

    <!-- Course Summary -->
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-chart-bar me-2"></i>Course Summary</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <h4 class="text-primary"><?= count($enrolledCourses) ?></h4>
                            <p class="text-muted mb-0">Enrolled Courses</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h4 class="text-success"><?= count($availableCourses) ?></h4>
                            <p class="text-muted mb-0">Available Courses</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h4 class="text-info"><?= count($enrolledCourses) + count($availableCourses) ?></h4>
                            <p class="text-muted mb-0">Total Courses</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h4 class="text-warning"><?= date('Y') ?></h4>
                            <p class="text-muted mb-0">Academic Year</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Listen for click on Enroll buttons
    $('.enroll-btn').on('click', function(e) {
        // Prevent default form submission behavior
        e.preventDefault();
        
        const $button = $(this);
        const courseId = $button.data('course-id');
        const courseTitle = $button.data('course-title');
        const courseDescription = $button.data('course-description');
        const originalText = $button.html();
        
        // Disable button and show loading
        $button.prop('disabled', true);
        $button.html('<i class="fas fa-spinner fa-spin me-1"></i>Enrolling...');
        
        // Use $.post() to send the course_id to /course/enroll URL
        $.post('<?= site_url('/course/enroll') ?>', {
            course_id: courseId
        })
        .done(function(data) {
            // On successful response from server
            if (data.success) {
                // Display Bootstrap alert message
                showAlert('success', data.message);
                
                // Hide/disable the Enroll button for that course
                $button.fadeOut(300, function() {
                    $button.html('<i class="fas fa-check me-1"></i>Enrolled').removeClass('btn-success').addClass('btn-secondary');
                });
                
                // Update the Enrolled Courses list dynamically without reloading
                addToEnrolledCourses(courseId, courseTitle, courseDescription);
                
                // Remove from available courses after animation
                setTimeout(function() {
                    $(`#available-course-${courseId}`).fadeOut(500, function() {
                        $(this).remove();
                        updateCourseCounts();
                    });
                }, 1000);
                
            } else {
                // Display error message
                showAlert('danger', data.message);
                // Re-enable button
                $button.prop('disabled', false);
                $button.html(originalText);
            }
        })
        .fail(function(xhr, status, error) {
            console.error('AJAX Error:', error);
            showAlert('danger', 'An error occurred while enrolling. Please try again.');
            // Re-enable button
            $button.prop('disabled', false);
            $button.html(originalText);
        });
    });
});

function addToEnrolledCourses(courseId, courseTitle, courseDescription) {
    const currentDate = new Date().toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
    });
    
    const enrolledCourseHtml = `
        <div class="col-md-6 col-lg-4 fade-in" id="enrolled-course-${courseId}">
            <div class="card h-100 position-relative">
                <span class="badge bg-success enrolled-badge">Enrolled</span>
                <div class="card-body">
                    <h5 class="card-title">${courseTitle}</h5>
                    <p class="card-text">${courseDescription}</p>
                    <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i>
                        Enrolled: ${currentDate}
                    </small>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">View Materials</button>
                    <button class="btn btn-outline-secondary btn-sm">Assignments</button>
                </div>
            </div>
        </div>
    `;
    
    // Check if there are existing enrolled courses
    if ($('#enrolledCoursesList').length > 0) {
        // Add to existing list
        $('#enrolledCoursesList').append(enrolledCourseHtml);
    } else {
        // Create new list and remove "no courses" alert
        $('#noEnrolledCoursesAlert').fadeOut(300, function() {
            $(this).remove();
            $('#enrolledCoursesContainer').html(`
                <div class="row g-3" id="enrolledCoursesList">
                    ${enrolledCourseHtml}
                </div>
            `);
        });
    }
}

function updateCourseCounts() {
    const enrolledCount = $('#enrolledCoursesList .col-md-6').length;
    const availableCount = $('#availableCoursesList .col-md-6').length;
    
    // Update counts in the summary section
    $('#enrolledCount').text(enrolledCount);
    $('.text-primary').first().text(enrolledCount);
    $('.text-success').first().text(availableCount);
    $('.text-info').first().text(enrolledCount + availableCount);
}

function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    $('#alertContainer').append(alertHtml);
    
    // Auto-dismiss after 5 seconds
    setTimeout(function() {
        $('#alertContainer .alert').first().fadeOut(500, function() {
            $(this).remove();
        });
    }, 5000);
}
</script>

<?= $this->endSection() ?>
