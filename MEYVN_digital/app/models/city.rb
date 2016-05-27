class City < ApplicationRecord
  validates :name, presence: true, uniqueness: { case_sensitive: false }, allow_nil:true
end
