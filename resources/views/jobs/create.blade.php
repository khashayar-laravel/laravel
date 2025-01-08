<x-layout>
<x-slot name="title">CreatingJob</x-slot>
    <div
        class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl"
    >
        <h2 class="text-4xl text-center font-bold mb-4">
            Create Job Listing
        </h2>
        <form method="POST" action="/job" enctype="multipart/form-data">
            @csrf
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>

            <x-inputs.text  id="title"
                            name="title"
                            label="Job Title"
                            placeholder="Software Engineer"/>

            <x-inputs.textaria id="description" name="description"
            label="Enter the Description"
            placeholder="Some Description..."
            />


            <x-inputs.text  id="salary"
                            type="number"
                            name="salary"
                            label="Salary"
                            placeholder="9000"/>

            <x-inputs.textaria id="requirements" name="requirements"
                               label="requirements"
                               placeholder="Some Requirements..."
            />

            <x-inputs.textaria id="benefits" name="benefits"
                               label="benefits"
                               placeholder="Some benefits..."
            />

            <x-inputs.text  id="tags"
                            name="tags"
                            label="Tags(comma-separated)"
                            placeholder="development, coding, java, python"/>

            <x-inputs.select id="job_type" name="job_type" label="Job Type"
             :options="['Full-Time' => 'Full-Time', 'Part-Time' => 'Part-Time', 'Contract' => 'Contract', 'Temporary' => 'Temporary', 'Internship' => 'Internship', 'Volunteer' => 'Volunteer', 'On-Call' => 'On-Call']"
            />

            <x-inputs.select id="remote" name="remote" label="Remote?"
             :options="[0=>'No', 1=>'Yes']"/>

            <x-inputs.text  id="address"
                            name="address"
                            label="Address"
                            placeholder="123 Main St"/>

            <x-inputs.text  id="city"
                            name="city"
                            label="City"
                            placeholder="Enter The City"/>

            <x-inputs.text  id="state"
                            name="state"
                            label="State"
                            placeholder="lA"/>

            <x-inputs.text  id="zipcode"
                            name="zipcode"
                            label="zipcode"
                            placeholder="38383"/>

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info
            </h2>

            <x-inputs.text  id="company_name"
                            name="company_name"
                            label="company_name"
                            placeholder="Dtweb"/>

            <x-inputs.textaria id="company_description" name="company_description"
                               label="company_description"
                               placeholder="Some company_description..."
            />

            <x-inputs.text  id="company_website"
                            name="company_website"
                            label="company_website"
                            type="url"
                            placeholder="irna.com"/>

            <x-inputs.text  id="contact_phone"
                            name="contact_phone"
                            label="contact-phone"
                            placeholder="0927366262"/>

            <x-inputs.text  id="contact_email"
                            name="contact_email"
                            label="contact-Email"
                            type="email"
                            placeholder="jjsdj@jfjf"/>

            <x-inputs.file id="company_logo" name="company_logo" label="SelectFile" />

            <button
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
            >
                Save
            </button>
        </form>
    </div>
</x-layout>


