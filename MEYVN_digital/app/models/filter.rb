class Filter < ApplicationRecord
  belongs_to :city, optional: true
  belongs_to :user

  validates :name, presence: true
  validate :filter_not_empty
  validate :end_date_is_after_start_date

  private
  def filter_not_empty
    c = city
    s = start_date
    e = end_date
    ev = event_name
    if !city && !start_date && !end_date && event_name.blank?
        errors.add(:Filter, "Can't have all except gis name name empty")
    end
  end
  def end_date_is_after_start_date
    if start_date && end_date && end_date < start_date
      errors.add(:end_date, 'end date cannot be before the start date')
    end
  end
end
