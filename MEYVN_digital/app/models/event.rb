class Event < ApplicationRecord
  belongs_to :city
  has_many :discussions

  validates :name, presence: true
  validates :start_date, presence: true
  validates :city, presence: true
  validate  :end_date_is_after_start_date_if_present

  private
  def end_date_is_after_start_date_if_present
    if start_date && end_date && end_date < start_date
      errors.add(:end_date, 'end date cannot be before the start date')
    end
  end
end
