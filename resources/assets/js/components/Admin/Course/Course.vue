<template>
    <div class="container">

        <small class="text-muted">Course Details</small>
        <div class="row">
            <div class="col-md-7 align-self-center">
                <h5 class="m-0">{{ course.code }} {{ course.title }}</h5>
            </div>
            <div class="col-md-5 align-self-center text-right">
                <a class="btn btn-primary" style="border-radius: 0;" :href="editCourseUrl" role="button">Edit Course</a>
                <button class="btn btn-danger" style="border-radius: 0;" @click="deleteCourse()">Delete Course</button>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-1">
                <small class="text-muted">ID</small>
                <p>{{ course.id }}</p>
            </div>
            <div class="col-md-3">
                <small class="text-muted">Code</small>
                <p>{{ course.code }}</p>
            </div>
            <div class="col-md-8">
                <small class="text-muted">Title</small>
                <p>{{ course.title }}</p>
            </div>
        </div>

        <small class="text-muted">Description</small>
        <p>{{ course.description }}</p>

        <small class="text-muted">Image</small>
        <p>
            <a role="button" class="border-0 p-0" :href="course.image_path" data-toggle="tooltip" data-placement="bottom" title="View">
                <i class="material-icons align-middle" style="font-size: 1.2em; color: #888;">visibility</i>
            </a>
            <span v-if="course.image">{{ course.image }}</span>
            <span v-else>none</span>
        </p>

        <small class="text-muted">Categories</small>
        <p v-if="course.categories.length" class="mt-2">
            <a role="button" v-for="category in course.categories" :key="category.id" :href="getCategoryUrl(category)" style="text-decoration: none; color: #000;">
                <span class="p-2 mr-1" style="background-color: #EEE">{{ category.title }}</span>
            </a>
        </p>
        <p v-else>none</p>

        <div class="row">
            <div class="col-md-4">
                <small class="text-muted">Created at</small>
                <p>{{ course.created_at }}</p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Updated at</small>
                <p>{{ course.updated_at }}</p>
            </div>
        </div>
   
        <hr>

        <div class="card-group mb-5">
            <div class="card bg-light border-0 m-1">
                <div class="card-body">
                    <div class="row m-0 p-3">
                        <div class="col-md-4 align-self-center text-center">
                            <i class="material-icons p-1" style="font-size: 100px; color: #004ecc;">format_align_left</i><br>
                        </div>
                        <div class="col-md-8 align-self-center text-right">
                            <p class="mb-1" style="font-size: 20;">Pages</p>
                            <h1>{{ course.pages_count }}</h1>
                            <small v-if="lastUpdatedPage" class="text-muted">Last updated at {{ lastUpdatedPage }}</small>
                            <small v-else class="text-muted">Last updated at ---</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="btn bg-light" style="border-radius: 0" :href="managePagesUrl" role="button">Manage Pages</a>
                </div>
            </div>
            <div class="card bg-light border-0 m-1">
                <div class="card-body">
                    <div class="row m-0 p-3">
                        <div class="col-md-4 align-self-center text-center">
                            <i class="material-icons p-1" style="font-size: 100px; color: #ffc800;">folder_open</i><br>
                        </div>
                        <div class="col-md-8 align-self-center text-right">
                            <p class="m-0" style="font-size: 20;">Files</p>
                            <h1>{{ course.files_count }}</h1>
                            <small v-if="lastUpdatedFile" class="text-muted">Last updated at {{ lastUpdatedFile }}</small>
                            <small v-else class="text-muted">Last updated at ---</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="btn bg-light" style="border-radius: 0" :href="manageFilesUrl" role="button">Manage Files</a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props: ['course', 'lastUpdatedPage', 'lastUpdatedFile'],
    data() {
        return {
            editCourseUrl: '/admin/courses/' + this.course.slug + '/edit',
            managePagesUrl: '/admin/courses/' + this.course.slug + '/pages',
            manageFilesUrl: '/admin/courses/' + this.course.slug + '/files',
        }
    },
    methods: {
        deleteCourse() {
            if(confirm('Are you sure you want to delete this course?')) {
                axios.delete('/api/admin/courses/' + this.course.id)
                    .then(response => {
                        window.location.href = '/admin/courses';
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        getCategoryUrl(category) {
            return '/admin/categories/' + category.slug;
        }
    },
}
</script>