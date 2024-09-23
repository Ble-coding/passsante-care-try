<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $id
 * @property int|null $owner_id
 * @property string|null $owner_type
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $country
 * @property string|null $state
 * @property string|null $city
 * @property string|null $postal_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereOwnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int|null $country_id
 * @property int|null $state_id
 * @property int|null $city_id
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereStateId($value)
 */
	class Address extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Appointment
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $patient_id
 * @property string $date
 * @property string $from_time
 * @property string $from_time_type
 * @property string $to_time
 * @property string $to_time_type
 * @property int $status
 * @property string|null $description
 * @property int $service_id
 * @property string $payable_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Service $services
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AppointmentFactory factory(...$parameters)
 * @method static Builder|Appointment newModelQuery()
 * @method static Builder|Appointment newQuery()
 * @method static Builder|Appointment query()
 * @method static Builder|Appointment whereCreatedAt($value)
 * @method static Builder|Appointment whereDate($value)
 * @method static Builder|Appointment whereDescription($value)
 * @method static Builder|Appointment whereDoctorId($value)
 * @method static Builder|Appointment whereFromTime($value)
 * @method static Builder|Appointment whereFromTimeType($value)
 * @method static Builder|Appointment whereId($value)
 * @method static Builder|Appointment wherePatientId($value)
 * @method static Builder|Appointment wherePayableAmount($value)
 * @method static Builder|Appointment whereServiceId($value)
 * @method static Builder|Appointment whereStatus($value)
 * @method static Builder|Appointment whereToTime($value)
 * @method static Builder|Appointment whereToTimeType($value)
 * @method static Builder|Appointment whereUpdatedAt($value)
 * @mixin Model
 * @property string $appointment_unique_id
 * @method static Builder|Appointment whereAppointmentUniqueId($value)
 * @property-read mixed $status_name
 * @property int $payment_type
 * @property int $payment_method
 * @property-read \App\Models\Transaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment wherePaymentType($value)
 */
	class Appointment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Appointment
 *
 * @property int $id
 * @property int $assistant_id
 * @property int $patient_id
 * @property string $date
 * @property string $from_time
 * @property string $from_time_type
 * @property string $to_time
 * @property string $to_time_type
 * @property int $status
 * @property string|null $description
 * @property int $service_id
 * @property string $payable_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Assistant $assistant
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\ServiceAssistant $service_assistants
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AppointmentFactory factory(...$parameters)
 * @method static Builder|AppointmentAssistant newModelQuery()
 * @method static Builder|AppointmentAssistant newQuery()
 * @method static Builder|AppointmentAssistant query()
 * @method static Builder|AppointmentAssistant whereCreatedAt($value)
 * @method static Builder|AppointmentAssistant whereDate($value)
 * @method static Builder|AppointmentAssistant whereDescription($value)
 * @method static Builder|AppointmentAssistant whereAssistantId($value)
 * @method static Builder|AppointmentAssistant whereFromTime($value)
 * @method static Builder|AppointmentAssistant whereFromTimeType($value)
 * @method static Builder|AppointmentAssistant whereId($value)
 * @method static Builder|AppointmentAssistant wherePatientId($value)
 * @method static Builder|AppointmentAssistant wherePayableAmount($value)
 * @method static Builder|AppointmentAssistant whereServiceId($value)
 * @method static Builder|AppointmentAssistant whereStatus($value)
 * @method static Builder|AppointmentAssistant whereToTime($value)
 * @method static Builder|AppointmentAssistant whereToTimeType($value)
 * @method static Builder|AppointmentAssistant whereUpdatedAt($value)
 * @mixin Model
 * @property string $appointment_unique_id
 * @method static Builder|AppointmentAssistant whereAppointmentUniqueId($value)
 * @property-read mixed $status_name
 * @property int $payment_type
 * @property int $payment_method
 * @property-read \App\Models\ServiceAssistant $services
 * @property-read \App\Models\TransactionAssistant|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentAssistant wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentAssistant wherePaymentType($value)
 */
	class AppointmentAssistant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AppointmentGoogleCalendar
 *
 * @property int $id
 * @property int $user_id
 * @property int $google_calendar_list_id
 * @property string $google_calendar_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GoogleCalendarList $googleCalendarList
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereGoogleCalendarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereGoogleCalendarListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppointmentGoogleCalendar whereUserId($value)
 * @mixin \Eloquent
 */
	class AppointmentGoogleCalendar extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Assistant
 *
 * @property int $id
 * @property int $user_id
 * @property float|null $experience
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Occupation[] $occupations
 * @property-read int|null $occupations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssistantSession[] $assistantSession
 * @property-read int|null $assistant_session_count
 * @property string|null $twitter_url
 * @property string|null $linkedin_url
 * @property string|null $instagram_url
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereInstagramUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereLinkedinUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereTwitterUrl($value)
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AppointmentAssistant> $appointments_assistant
 * @property-read int|null $appointments_assistant_count
 * @property-read \App\Models\User $assistantUser
 * @property-read string $full_name
 * @property-read string $profile_image
 * @property-read mixed $role_display_name
 * @property-read mixed $role_name
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review_assistant> $reviews_assistants
 * @property-read int|null $reviews_assistants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Specialization> $specializations
 * @property-read int|null $specializations_count
 * @property-read \App\Models\User $testUser
 * @method static \Database\Factories\AssistantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant role($roles, $guard = null)
 */
	class Assistant extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\AssistantHoliday
 *
 * @property int $id
 * @property string|null $name
 * @property int $assistant_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Assistant $assistant
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereassistantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereAssistantId($value)
 */
	class AssistantHoliday extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AssistantSession
 *
 * @property int $id
 * @property int $assistant_id
 * @property string $session_meeting_time
 * @property string $session_gap
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Assistant $assistant
 * @property-read Collection|WeekDay_assistant[] $sessionWeekDays
 * @property-read int|null $session_week_days_assistant_count
 * @method static AssistantSessionFactory factory(...$parameters)
 * @method static Builder|AssistantSession newModelQuery()
 * @method static Builder|AssistantSession newQuery()
 * @method static Builder|AssistantSession query()
 * @method static Builder|AssistantSession whereCreatedAt($value)
 * @method static Builder|AssistantSession whereAssistantId($value)
 * @method static Builder|AssistantSession whereId($value)
 * @method static Builder|AssistantSession whereSessionGap($value)
 * @method static Builder|AssistantSession whereSessionMeetingTime($value)
 * @method static Builder|AssistantSession whereUpdatedAt($value)
 * @property-read int|null $session_week_days_count
 */
	class AssistantSession extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Assistant_occupation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant_occupation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant_occupation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant_occupation query()
 */
	class Assistant_occupation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Medicine[] $medicines
 * @property-read int|null $medicines_count
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Brand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Brand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Medicine[] $medicines
 * @property-read int|null $medicines_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * Class City
 *
 * @version July 31, 2021, 7:41 am UTC
 * @property string $name
 * @property string $state_id
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read State $state
 * @method static \Database\Factories\CityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @mixin Model
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClinicSchedule
 *
 * @property int $id
 * @property string $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ClinicSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClinicScheduleAssistant
 *
 * @property int $id
 * @property string $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicScheduleAssistant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicScheduleAssistant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicScheduleAssistant query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicScheduleAssistant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicScheduleAssistant whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicScheduleAssistant whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicScheduleAssistant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicScheduleAssistant whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicScheduleAssistant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ClinicScheduleAssistant extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Country
 *
 * @version July 29, 2021, 10:49 am UTC
 * @property string $name
 * @property string $short_code
 * @property int $id
 * @property string|null $phone_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Database\Factories\CountryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country wherePhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereShortCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @mixin Model
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Currency
 *
 * @version August 26, 2021, 6:57 am UTC
 * @property string $currency_name
 * @property string $currency_icon
 * @property string $currency_code
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\CurrencyFactory factory(...$parameters)
 * @method static Builder|Currency newModelQuery()
 * @method static Builder|Currency newQuery()
 * @method static Builder|Currency query()
 * @method static Builder|Currency whereCreatedAt($value)
 * @method static Builder|Currency whereCurrencyCode($value)
 * @method static Builder|Currency whereCurrencyIcon($value)
 * @method static Builder|Currency whereCurrencyName($value)
 * @method static Builder|Currency whereId($value)
 * @method static Builder|Currency whereUpdatedAt($value)
 * @mixin Model
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Doctor
 *
 * @property int $id
 * @property int $user_id
 * @property float|null $experience
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Specialization[] $specializations
 * @property-read int|null $specializations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DoctorSession[] $doctorSession
 * @property-read int|null $doctor_session_count
 * @property string|null $twitter_url
 * @property string|null $linkedin_url
 * @property string|null $instagram_url
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereInstagramUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereLinkedinUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereTwitterUrl($value)
 * @property-read \App\Models\User $doctorUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\User $testUser
 */
	class Doctor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DoctorHoliday
 *
 * @property int $id
 * @property string|null $name
 * @property int $doctor_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday query()
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorHoliday whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class DoctorHoliday extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DoctorSession
 *
 * @property int $id
 * @property int $doctor_id
 * @property string $session_meeting_time
 * @property string $session_gap
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Doctor $doctor
 * @property-read Collection|WeekDay[] $sessionWeekDays
 * @property-read int|null $session_week_days_count
 * @method static DoctorSessionFactory factory(...$parameters)
 * @method static Builder|DoctorSession newModelQuery()
 * @method static Builder|DoctorSession newQuery()
 * @method static Builder|DoctorSession query()
 * @method static Builder|DoctorSession whereCreatedAt($value)
 * @method static Builder|DoctorSession whereDoctorId($value)
 * @method static Builder|DoctorSession whereId($value)
 * @method static Builder|DoctorSession whereSessionGap($value)
 * @method static Builder|DoctorSession whereSessionMeetingTime($value)
 * @method static Builder|DoctorSession whereUpdatedAt($value)
 */
	class DoctorSession extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Enquiry
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $subject
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $view
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereView($value)
 * @property string|null $region_code
 * @property-read string $view_name
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereRegionCode($value)
 */
	class Enquiry extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Faq
 *
 * @version September 21, 2021, 12:51 pm UTC
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $is_default
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\FaqFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereUpdatedAt($value)
 * @mixin Model
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * Class FrontPatientTestimonial
 *
 * @version September 22, 2021, 11:20 am UTC
 * @property int $id
 * @property string $name
 * @property string $designation
 * @property string $short_description
 * @property int $is_default
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\FrontPatientTestimonialFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontPatientTestimonial whereUpdatedAt($value)
 * @mixin Model
 * @property-read string $front_patient_profile
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 */
	class FrontPatientTestimonial extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\GoogleCalendarIntegration
 *
 * @property int $id
 * @property int $user_id
 * @property string $access_token
 * @property mixed $meta
 * @property string $last_used_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarIntegration whereUserId($value)
 * @mixin \Eloquent
 */
	class GoogleCalendarIntegration extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GoogleCalendarList
 *
 * @property int $id
 * @property int $user_id
 * @property string $calendar_name
 * @property string $google_calendar_id
 * @property mixed $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AppointmentGoogleCalendar $appointmentGoogleCalendar
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList query()
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereCalendarName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereGoogleCalendarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GoogleCalendarList whereUserId($value)
 * @mixin \Eloquent
 */
	class GoogleCalendarList extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Encounter
 *
 * @version September 3, 2021, 7:09 am UTC
 * @property string $doctor
 * @property string $patient
 * @property string $description
 * @property int $id
 * @property int $doctor_id
 * @property int $patient_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\EncounterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereEncounterDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereUpdatedAt($value)
 * @mixin Model
 * @property string $visit_date
 * @property-read Doctor $visitDoctor
 * @property-read \App\Models\Patient $visitPatient
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereVisitDate($value)
 * @property-read \App\Models\Assistant|null $assistanceAssistant
 * @property-read \App\Models\Assistant|null $assistant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitNote> $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitObservation> $observations
 * @property-read int|null $observations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitPrescription> $prescriptions
 * @property-read int|null $prescriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitProblem> $problems
 * @property-read int|null $problems_count
 */
	class Historique extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LiveConsultation
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $patient_id
 * @property string $title
 * @property \Illuminate\Support\Carbon $start_date_time
 * @property int $duration_in_minute
 * @property string $consultation_title
 * @property \Illuminate\Support\Carbon $consultation_date
 * @property bool $host_video
 * @property bool $participant_video
 * @property string $consultation_duration_minutes
 * @property string $created_by
 * @property int|null $status
 * @property string|null $description
 * @property string|null $meeting_id
 * @property array|null $meta
 * @property string|null $time_zone
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereConsultationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereConsultationDurationMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereConsultationTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereDurationInMinute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereHostVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereMeetingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereParticipantVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereStartDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultation whereUpdatedAt($value)
 */
	class LiveConsultation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LiveConsultationGoogleMeet
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $patient_id
 * @property string $title
 * @property string $start_date_time
 * @property int $duration_in_minute
 * @property string $consultation_title
 * @property \Illuminate\Support\Carbon $consultation_date
 * @property bool $host_video
 * @property bool $participant_video
 * @property string $consultation_duration_minutes
 * @property string $created_by
 * @property int|null $status
 * @property string|null $description
 * @property string|null $meeting_id
 * @property array|null $meta
 * @property string|null $time_zone
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereConsultationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereConsultationDurationMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereConsultationTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereDurationInMinute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereHostVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereMeetingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereParticipantVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereStartDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveConsultationGoogleMeet whereUpdatedAt($value)
 */
	class LiveConsultationGoogleMeet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LiveZoom
 *
 * @method static \Database\Factories\LiveZoomFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|LiveZoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveZoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveZoom query()
 */
	class LiveZoom extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Medicine
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $brand_id
 * @property string $name
 * @property float $selling_price
 * @property float $buying_price
 * @property int $quantity
 * @property int $available_quantity
 * @property string $salt_composition
 * @property string|null $description
 * @property string|null $side_effects
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Brand|null $brand
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereAvailableQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereBuyingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereSaltComposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereSideEffects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $currency_symbol
 * @property-read \App\Models\PrescriptionMedicineModal|null $prescriptionMedicines
 * @property-read \App\Models\PurchasedMedicine|null $purchasedMedicine
 * @property-read \App\Models\UsedMedicine|null $usedMedicines
 * @method static \Illuminate\Database\Eloquent\Builder|Medicine whereCurrencySymbol($value)
 */
	class Medicine extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MedicineBill
 *
 * @property int $id
 * @property string $bill_number
 * @property int $patient_id
 * @property int|null $doctor_id
 * @property string $model_type
 * @property string $model_id
 * @property int|null $case_id
 * @property int $admission_id
 * @property float $discount
 * @property float $amount
 * @property float $paid_amount
 * @property int $payment_status
 * @property float $balance_amount
 * @property int $payment_type
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor|null $doctor
 * @property-read \App\Models\Patient|null $patient
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SaleMedicine[] $saleMedicine
 * @property-read int|null $sale_medicine_count
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill query()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereAdmissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereBalanceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereBillNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $net_amount
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereNetAmount($value)
 * @property float $total
 * @property float $tax_amount
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereTotal($value)
 * @property string $bill_date
 * @method static \Illuminate\Database\Eloquent\Builder|MedicineBill whereBillDate($value)
 */
	class MedicineBill extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $type
 * @property string|null $description
 * @property string|null $read_at
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 * @mixin \Eloquent
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NotificationAssistant
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $type
 * @property string|null $description
 * @property string|null $read_at
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 * @mixin \Eloquent
 */
	class NotificationAssistant extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Specialization
 *
 * @version August 2, 2021, 10:19 am UTC
 * @property string $name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\OccupationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|occupation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|occupation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|occupation query()
 * @method static \Illuminate\Database\Eloquent\Builder|occupation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|occupation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|occupation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|occupation whereUpdatedAt($value)
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Doctor[] $doctors
 * @property-read int|null $doctors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Assistant> $assistants
 * @property-read int|null $assistants_count
 */
	class Occupation extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Patient
 *
 * @version July 29, 2021, 11:37 am UTC
 * @property int $id
 * @property string $patient_unique_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static PatientFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static Builder|Patient onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePatientUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUserId($value)
 * @method static Builder|Patient withTrashed()
 * @method static Builder|Patient withoutTrashed()
 * @mixin Model
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read string $profile
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Patient permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient role($roles, $guard = null)
 * @property int|null $template_id
 * @property string|null $qr_code
 * @property string $lieu_de_residence
 * @property string $profession
 * @property string $niveau_scolaire
 * @property string $cas_social
 * @property string $categorie
 * @property string $matrimonial
 * @property-read \App\Models\User $patientUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\SmartPatientCards|null $smartPatientCard
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCasSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCategorie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereLieuDeResidence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereMatrimonial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereNiveauScolaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereProfession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereTemplateId($value)
 */
	class Patient extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\PaymentGateway
 *
 * @property int $id
 * @property int $payment_gateway_id
 * @property string $payment_gateway
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway wherePaymentGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway wherePaymentGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PaymentGateway extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentGatewayAssistant
 *
 * @property int $id
 * @property int $payment_gateway_id
 * @property string $payment_gateway
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant wherePaymentGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant wherePaymentGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PaymentGatewayAssistant extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Role
 *
 * @version August 5, 2021, 10:43 am UTC
 * @property string $name
 * @property int $id
 * @property string $display_name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @mixin Model
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Encounter
 *
 * @version September 3, 2021, 7:09 am UTC
 * @property string $assistant
 * @property string $patient
 * @property string $description
 * @property int $id
 * @property int $assistant_id
 * @property int $patient_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\EncounterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance query()
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereAssistantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereEncounterDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereUpdatedAt($value)
 * @mixin Model
 * @property string $assistance_date
 * @property-read Assistant $assistanceAssistant
 * @property-read \App\Models\Patient $assistancePatient
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereAssistanceDate($value)
 * @property string $heure_debut
 * @property string $heure_fin
 * @property int $statut
 * @property array|null $vulnerabilites
 * @property int|null $type
 * @property int|null $motif_enquete
 * @property int|null $decision
 * @property int|null $etat_enquete
 * @property array|null $motif_service
 * @property string|null $autre_motif_service
 * @property array|null $activites_menees
 * @property string|null $autres_activites
 * @property int|null $delai
 * @property int|null $resultat_realisation
 * @property array|null $devenir_du_cas
 * @property string|null $observation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitNote> $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitObservation> $observations
 * @property-read int|null $observations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitPrescription> $prescriptions
 * @property-read int|null $prescriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitProblem> $problems
 * @property-read int|null $problems_count
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereActivitesMenees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereAutreMotifService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereAutresActivites($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereDecision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereDelai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereDevenirDuCas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereEtatEnquete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereHeureDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereHeureFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereMotifEnquete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereMotifService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereResultatRealisation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereVulnerabilites($value)
 */
	class PortezAssistance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Prescription
 *
 * @property int $id
 * @property int $appointment_id
 * @property int $patient_id
 * @property int|null $doctor_id
 * @property string|null $food_allergies
 * @property string|null $tendency_bleed
 * @property string|null $heart_disease
 * @property string|null $high_blood_pressure
 * @property string|null $diabetic
 * @property string|null $surgery
 * @property string|null $accident
 * @property string|null $others
 * @property string|null $medical_history
 * @property string|null $current_medication
 * @property string|null $female_pregnancy
 * @property string|null $breast_feeding
 * @property string|null $health_insurance
 * @property string|null $low_income
 * @property string|null $reference
 * @property bool|null $status
 * @property string|null $plus_rate
 * @property string|null $temperature
 * @property string|null $problem_description
 * @property string|null $test
 * @property string|null $advice
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor|null $doctor
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereAccident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereAdvice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereBreastFeeding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereCurrentMedication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereDiabetic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereFemalePregnancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereFoodAllergies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereHealthInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereHeartDisease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereHighBloodPressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereLowIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereMedicalHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereOthers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription wherePlusRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereProblemDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereSurgery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereTendencyBleed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Prescription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PrescriptionMedicineModal
 *
 * @property int $id
 * @property int $prescription_id
 * @property int $medicine
 * @property string|null $dosage
 * @property string|null $day
 * @property string|null $time
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Medicine[] $medicines
 * @property-read int|null $medicines_count
 * @property-read \App\Models\Prescription $prescription
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereDosage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereMedicine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal wherePrescriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $dose_interval
 * @method static \Illuminate\Database\Eloquent\Builder|PrescriptionMedicineModal whereDoseInterval($value)
 */
	class PrescriptionMedicineModal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchaseMedicine
 *
 * @property int $id
 * @property string $purchase_no
 * @property float $tax
 * @property float $total
 * @property float $net_amount
 * @property int $payment_type
 * @property float $discount
 * @property string|null $note
 * @property string|null $payment_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PurchasedMedicine> $purchasedMedcines
 * @property-read int|null $purchased_medcines_count
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine whereNetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine wherePaymentNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine wherePurchaseNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseMedicine whereUpdatedAt($value)
 */
	class PurchaseMedicine extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchasedMedicine
 *
 * @property int $id
 * @property int $purchase_medicines_id
 * @property int|null $medicine_id
 * @property string|null $expiry_date
 * @property string $lot_no
 * @property float $tax
 * @property int $quantity
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Medicine|null $medicines
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereLotNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereMedicineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine wherePurchaseMedicinesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedMedicine whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PurchasedMedicine extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Qualification
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $degree
 * @property string|null $university
 * @property string|null $year
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereUniversity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereYear($value)
 * @mixin \Eloquent
 */
	class Qualification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property string $review
 * @property int $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Patient $patient
 */
	class Review extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $patient_id
 * @property int $assistant_id
 * @property string $review
 * @property int $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereAssistantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Assistant $assistant
 * @property-read \App\Models\Patient $patient
 */
	class Review_assistant extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Role
 *
 * @version August 5, 2021, 10:43 am UTC
 * @property string $name
 * @property int $id
 * @property string $display_name
 * @property int $is_default
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static RoleFactory factory(...$parameters)
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role permission($permissions)
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereDisplayName($value)
 * @method static Builder|Role whereGuardName($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereIsDefault($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @mixin Model
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SaleMedicine
 *
 * @property int $id
 * @property int $medicine_bill_id
 * @property int $medicine_id
 * @property int $sale_quantity
 * @property float $tax
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Medicine|null $medicine
 * @property-read \App\Models\MedicineBill|null $medicineBill
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereMedicineBillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereMedicineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereSaleQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $sale_price
 * @property string $expiry_date
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleMedicine whereSalePrice($value)
 */
	class SaleMedicine extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Services
 *
 * @version August 2, 2021, 12:09 pm UTC
 * @property string $category
 * @property string $name
 * @property string $charges
 * @property string $doctors
 * @property sting $status
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ServicesFactory factory(...$parameters)
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service whereCategory($value)
 * @method static Builder|Service whereCharges($value)
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereDoctors($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereName($value)
 * @method static Builder|Service whereStatus($value)
 * @method static Builder|Service whereUpdatedAt($value)
 * @mixin Model
 * @property string $category_id
 * @property-read ServiceCategory $serviceCategory
 * @property-read Collection|\App\Models\Doctor[] $serviceDoctors
 * @property-read int|null $service_doctors_count
 * @method static Builder|Service whereCategoryId($value)
 * @property string $short_description
 * @property-read string $icon
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereShortDescription($value)
 */
	class Service extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class ServiceAssistants
 *
 * @version August 2, 2021, 12:09 pm UTC
 * @property string $category
 * @property string $name
 * @property string $charges
 * @property string $assistants
 * @property sting $status
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ServiceAssistantsFactory factory(...$parameters)
 * @method static Builder|ServiceAssistant newModelQuery()
 * @method static Builder|ServiceAssistant newQuery()
 * @method static Builder|ServiceAssistant query()
 * @method static Builder|ServiceAssistant whereCategory($value)
 * @method static Builder|ServiceAssistant whereCharges($value)
 * @method static Builder|ServiceAssistant whereCreatedAt($value)
 * @method static Builder|ServiceAssistant whereAssistants($value)
 * @method static Builder|ServiceAssistant whereId($value)
 * @method static Builder|ServiceAssistant whereName($value)
 * @method static Builder|ServiceAssistant whereStatus($value)
 * @method static Builder|ServiceAssistant whereUpdatedAt($value)
 * @mixin Model
 * @property string $category_id
 * @property-read ServiceCategory $serviceCategory
 * @property-read Collection|\App\Models\Assistant[] $serviceAssistants
 * @property-read int|null $service_assistants_count
 * @method static Builder|ServiceAssistant whereCategoryId($value)
 * @property string $short_description
 * @property-read string $icon
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceAssistant whereShortDescription($value)
 */
	class ServiceAssistant extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class ServiceAssistantCategory
 *
 * @version August 2, 2021, 7:11 am UTC
 * @property string $name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ServiceAssistantCategoryFactory factory(...$parameters)
 * @method static Builder|ServiceAssistantCategory newModelQuery()
 * @method static Builder|ServiceAssistantCategory newQuery()
 * @method static Builder|ServiceAssistantCategory query()
 * @method static Builder|ServiceAssistantCategory whereCreatedAt($value)
 * @method static Builder|ServiceAssistantCategory whereId($value)
 * @method static Builder|ServiceAssistantCategory whereName($value)
 * @method static Builder|ServiceAssistantCategory whereUpdatedAt($value)
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceAssistant> $activatedServices
 * @property-read int|null $activated_services_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceAssistant> $services
 * @property-read int|null $services_count
 */
	class ServiceAssistantCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ServiceCategory
 *
 * @version August 2, 2021, 7:11 am UTC
 * @property string $name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ServiceCategoryFactory factory(...$parameters)
 * @method static Builder|ServiceCategory newModelQuery()
 * @method static Builder|ServiceCategory newQuery()
 * @method static Builder|ServiceCategory query()
 * @method static Builder|ServiceCategory whereCreatedAt($value)
 * @method static Builder|ServiceCategory whereId($value)
 * @method static Builder|ServiceCategory whereName($value)
 * @method static Builder|ServiceCategory whereUpdatedAt($value)
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $activatedServices
 * @property-read int|null $activated_services_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 */
	class ServiceCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Country $country
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Setting permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting role($roles, $guard = null)
 */
	class Setting extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property int $is_default
 * @property-read string $slider_image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereIsDefault($value)
 */
	class Slider extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\SmartPatientCards
 *
 * @property int $id
 * @property string $template_name
 * @property string $address
 * @property string $header_color
 * @property int $show_email
 * @property int $show_phone
 * @property int $show_dob
 * @property int $show_blood_group
 * @property int $show_address
 * @property int $show_patient_unique_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Patient|null $patient
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards query()
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereHeaderColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereShowAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereShowBloodGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereShowDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereShowEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereShowPatientUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereShowPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartPatientCards whereUpdatedAt($value)
 */
	class SmartPatientCards extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class Specialization
 *
 * @version August 2, 2021, 10:19 am UTC
 * @property string $name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\SpecializationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization query()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereUpdatedAt($value)
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Doctor[] $doctors
 * @property-read int|null $doctors_count
 */
	class Specialization extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Staff
 *
 * @version August 6, 2021, 10:17 am UTC
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone_number
 * @property string $password
 * @property string $gender
 * @property string $role
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static StaffFactory factory(...$parameters)
 * @method static Builder|Staff newModelQuery()
 * @method static Builder|Staff newQuery()
 * @method static Builder|Staff query()
 * @method static Builder|Staff whereCreatedAt($value)
 * @method static Builder|Staff whereEmail($value)
 * @method static Builder|Staff whereFirstName($value)
 * @method static Builder|Staff whereGender($value)
 * @method static Builder|Staff whereId($value)
 * @method static Builder|Staff whereLastName($value)
 * @method static Builder|Staff wherePassword($value)
 * @method static Builder|Staff wherePhoneNumber($value)
 * @method static Builder|Staff whereUpdatedAt($value)
 * @mixin Model
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[]
 *     $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static Builder|Staff permission($permissions)
 * @method static Builder|Staff role($roles, $guard = null)
 */
	class Staff extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class State
 *
 * @version July 29, 2021, 11:48 am UTC
 * @property string $name
 * @property int $country_id
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereUpdatedAt($value)
 * @mixin Model
 */
	class State extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subscribe
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $email
 * @property int $subscribe
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereSubscribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe query()
 */
	class Subscribe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $user_id
 * @property string $transaction_id
 * @property string $appointment_id
 * @property float $amount
 * @property int $type
 * @property string $meta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Transaction newModelQuery()
 * @method static Builder|Transaction newQuery()
 * @method static Builder|Transaction query()
 * @method static Builder|Transaction whereAmount($value)
 * @method static Builder|Transaction whereAppointmentId($value)
 * @method static Builder|Transaction whereCreatedAt($value)
 * @method static Builder|Transaction whereId($value)
 * @method static Builder|Transaction whereMeta($value)
 * @method static Builder|Transaction whereTransactionId($value)
 * @method static Builder|Transaction whereType($value)
 * @method static Builder|Transaction whereUpdatedAt($value)
 * @method static Builder|Transaction whereUserId($value)
 * @mixin \Eloquent
 * @property bool|null $status
 * @property int|null $accepted_by
 * @property-read \App\Models\User|null $acceptedPaymentUser
 * @property-read \App\Models\Appointment|null $appointment
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAcceptedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TransactionAssistant
 *
 * @property int $id
 * @property int $user_id
 * @property string $transaction_id
 * @property string $appointment_id
 * @property float $amount
 * @property int $type
 * @property string $meta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|TransactionAssistant newModelQuery()
 * @method static Builder|TransactionAssistant newQuery()
 * @method static Builder|TransactionAssistant query()
 * @method static Builder|TransactionAssistant whereAmount($value)
 * @method static Builder|TransactionAssistant whereAppointmentId($value)
 * @method static Builder|TransactionAssistant whereCreatedAt($value)
 * @method static Builder|TransactionAssistant whereId($value)
 * @method static Builder|TransactionAssistant whereMeta($value)
 * @method static Builder|TransactionAssistant whereTransactionId($value)
 * @method static Builder|TransactionAssistant whereType($value)
 * @method static Builder|TransactionAssistant whereUpdatedAt($value)
 * @method static Builder|TransactionAssistant whereUserId($value)
 * @mixin \Eloquent
 * @property bool|null $status
 * @property int|null $accepted_by
 * @property-read \App\Models\User|null $acceptedPaymentUser
 * @property-read \App\Models\AppointmentAssistant|null $appointment
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionAssistant whereAcceptedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionAssistant whereStatus($value)
 */
	class TransactionAssistant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UsedMedicine
 *
 * @property int $id
 * @property int $stock_used
 * @property int|null $medicine_id
 * @property int $model_id
 * @property string $model_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereMedicineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereStockUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsedMedicine whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Medicine|null $medicine
 */
	class UsedMedicine extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $contact
 * @property string|null $dob
 * @property int $gender
 * @property int $status
 * @property string|null $language
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Address|null $address
 * @property-read Doctor|null $doctor
 * @property-read string $full_name
 * @property-read string $profile_image
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[]
 *     $notifications
 * @property-read int|null $notifications_count
 * @property-read Patient|null $patient
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereContact($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDob($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereGender($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLanguage($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @property int|null $type
 * @property string|null $blood_group
 * @property-read mixed $role_name
 * @property-read Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|Qualification[] $qualifications
 * @property-read int|null $qualifications_count
 * @property-read Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static Builder|User permission($permissions)
 * @method static Builder|User role($roles, $guard = null)
 * @method static Builder|User whereBloodGroup($value)
 * @method static Builder|User whereType($value)
 * @property-read \App\Models\Staff|null $staff
 * @property string|null $region_code
 * @method static Builder|User whereRegionCode($value)
 * @property bool $email_notification
 * @property string|null $time_zone
 * @property bool $dark_mode
 * @property-read \App\Models\Assistant|null $assistant
 * @property-read \App\Models\GoogleCalendarIntegration|null $gCredentials
 * @property-read mixed $role_display_name
 * @property-read \App\Models\UserGoogleMeetCredential|null $googleMeetCredential
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDarkMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTimeZone($value)
 */
	class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\UserGoogleAppointment
 *
 * @property int $id
 * @property int $user_id
 * @property string $appointment_id
 * @property string $google_calendar_id
 * @property string $google_event_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment whereGoogleCalendarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment whereGoogleEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleAppointment whereUserId($value)
 */
	class UserGoogleAppointment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserGoogleMeetCredential
 *
 * @property int $id
 * @property int $user_id
 * @property string $google_meet_api_key
 * @property string $google_meet_refresh_token
 * @property string|null $google_meet_access_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereGoogleMeetApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereGoogleMeetRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereGoogleMeetAccessToken($value)
 * @mixin \Eloquent
 */
	class UserGoogleMeetCredential extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserZoomCredential
 *
 * @property int $id
 * @property int $user_id
 * @property string $zoom_api_key
 * @property string $zoom_api_secret
 * @property string $zoom_api_account
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereZoomApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereZoomApiSecret($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereZoomApiAccount($value)
 */
	class UserZoomCredential extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Encounter
 *
 * @version September 3, 2021, 7:09 am UTC
 * @property string $doctor
 * @property string $patient
 * @property string $description
 * @property int $id
 * @property int $doctor_id
 * @property int $patient_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @mixin Model
 * @property string $visit_date
 * @property-read Doctor $visitDoctor
 * @property-read \App\Models\Patient $visitPatient
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereVisitDate($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitNote> $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitObservation> $observations
 * @property-read int|null $observations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitPrescription> $prescriptions
 * @property-read int|null $prescriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitProblem> $problems
 * @property-read int|null $problems_count
 * @method static \Illuminate\Database\Eloquent\Builder|Visit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereUpdatedAt($value)
 */
	class Visit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VisitNote
 *
 * @property int $id
 * @property string $note_name
 * @property int $visit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereNoteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitNote whereVisitId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Visit $visit
 */
	class VisitNote extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VisitObservation
 *
 * @property int $id
 * @property string $observation_name
 * @property int $visit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereObservationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereVisitId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Visit $visit
 */
	class VisitObservation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VisitPrescription
 *
 * @property int $id
 * @property int $visit_id
 * @property string $prescription_name
 * @property string $frequency
 * @property string $duration
 * @property mixed $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription wherePrescriptionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereVisitId($value)
 * @mixin \Eloquent
 */
	class VisitPrescription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VisitProblem
 *
 * @property int $id
 * @property string $problem_name
 * @property int $visit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereProblemName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitProblem whereVisitId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Visit $visit
 */
	class VisitProblem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WeekDay
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $doctor_session_id
 * @property string $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property string $start_time_type
 * @property string $end_time_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay query()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereDoctorSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereEndTimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereStartTimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read mixed $full_end_time
 * @property-read mixed $full_start_time
 * @property-read \App\Models\DoctorSession $doctorSession
 */
	class WeekDay extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WeekDay_assistant
 *
 * @property int $id
 * @property int $assistant_id
 * @property int $assistant_session_id
 * @property string $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property string $start_time_type
 * @property string $end_time_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant query()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereAssistantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereAssistantSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereEndTimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereStartTimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read mixed $full_end_time
 * @property-read mixed $full_start_time
 * @property-read \App\Models\AssistantSession $assistantSession
 */
	class WeekDay_assistant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ZoomOAuth
 *
 * @property int $id
 * @property int $user_id
 * @property string $access_token
 * @property string $refresh_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomOAuth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomOAuth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomOAuth query()
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomOAuth whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomOAuth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomOAuth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomOAuth whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomOAuth whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZoomOAuth whereUserId($value)
 */
	class ZoomOAuth extends \Eloquent {}
}

