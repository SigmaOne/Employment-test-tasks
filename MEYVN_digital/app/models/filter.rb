class Filter < ApplicationRecord
  belongs_to :city, optional: true
  belongs_to :user

  validates :name, presence: true
  validates :event_name, presence: true, allow_nil: true
  validates :city, presence: true, allow_nil: true
  validates :start_date, presence: true, allow_nil: true
  validates :end_date, presence: true, allow_nil: true
  validate :filter_not_empty
  validate :end_date_is_after_start_date

  private
  def filter_not_empty
    if city.nil? && start_date.nil? && end_date.nil? && event_name.nil?
        errors.add(:Filter, "Filter can't be empty")
    end
  end
  def end_date_is_after_start_date
    if start_date && end_date && end_date < start_date
      errors.add(:end_date, 'end date cannot be before the start date')
    end
  end
end
